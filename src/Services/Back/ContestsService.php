<?php

namespace InetStudio\Contests\Services\Back;

use League\Fractal\Manager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Services\Back\ContestsServiceContract;
use InetStudio\Contests\Contracts\Http\Requests\Back\SaveContestRequestContract;

/**
 * Class ContestsService.
 */
class ContestsService implements ContestsServiceContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services = [];

    /**
     * @var
     */
    public $repository;

    /**
     * ContestsService constructor.
     */
    public function __construct()
    {
        $this->services['meta'] = app()->make('InetStudio\Meta\Contracts\Services\Back\MetaServiceContract');
        $this->services['images'] = app()->make('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract');
        $this->services['files'] = app()->make('InetStudio\Uploads\Contracts\Services\Back\FilesServiceContract');
        $this->services['tags'] = app()->make('InetStudio\Tags\Contracts\Services\Back\TagsServiceContract');
        $this->services['products'] = app()->make('InetStudio\Products\Contracts\Services\Back\ProductsServiceContract');
        $this->services['categories'] = app()->make('InetStudio\Categories\Contracts\Services\Back\CategoriesServiceContract');
        $this->services['access'] = app()->make('InetStudio\Access\Contracts\Services\Back\AccessServiceContract');
        $this->services['widgets'] = app()->make('InetStudio\Widgets\Contracts\Services\Back\WidgetsServiceContract');

        $this->repository = app()->make('InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract');
    }

    /**
     * Возвращаем объект модели.
     *
     * @param int $id
     *
     * @return ContestModelContract
     */
    public function getContestObject(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Возвращаем объекты по списку id.
     *
     * @param array|int $ids
     * @param bool $returnBuilder
     *
     * @return mixed
     */
    public function getContestsByIDs($ids, bool $returnBuilder = false)
    {
        return $this->repository->getItemsByIDs($ids, [], [], $returnBuilder);
    }

    /**
     * Сохраняем модель.
     *
     * @param SaveContestRequestContract $request
     * @param int $id
     *
     * @return ContestModelContract
     */
    public function save(SaveContestRequestContract $request, int $id): ContestModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';
        $item = $this->repository->save($request->only($this->repository->getModel()->getFillable()), $id);

        $this->services['meta']->attachToObject($request, $item);

        $images = (config('contests.images.conversions.'.$item->material_type)) ? array_keys(config('contests.images.conversions.'.$item->material_type)) : [];
        $this->services['images']->attachToObject($request, $item, $images, 'contests', $item->material_type);
        $this->services['files']->attachToObject($item, ['rules'], 'contests');

        $this->services['tags']->attachToObject($request, $item);
        $this->services['products']->attachToObject($request, $item);
        $this->services['categories']->attachToObject($request, $item);
        $this->services['access']->attachToObject($request, $item);
        $this->services['widgets']->attachToObject($request, $item);

        $item->searchable();

        event(app()->makeWith('InetStudio\Contests\Contracts\Events\Back\ModifyContestEventContract', [
            'object' => $item,
        ]));

        Session::flash('success', 'Конкурс «'.$item->title.'» успешно '.$action);

        return $item;
    }

    /**
     * Удаляем модель.
     *
     * @param int $id
     *
     * @return bool|null
     */
    public function destroy(int $id): ?bool
    {
        return $this->repository->destroy($id);
    }

    /**
     * Возвращаем подсказки.
     *
     * @param string $search
     * @param $type
     *
     * @return array
     */
    public function getSuggestions(string $search, $type): array
    {
        $items = $this->repository->searchItems([['title', 'LIKE', '%'.$search.'%']]);

        $resource = (app()->makeWith('InetStudio\Contests\Contracts\Transformers\Back\SuggestionTransformerContract', [
            'type' => $type,
        ]))->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        if ($type && $type == 'autocomplete') {
            $data['suggestions'] = $transformation['data'];
        } else {
            $data['items'] = $transformation['data'];
        }

        return $data;
    }

    /**
     * Возвращаем статистику битв по статусу.
     *
     * @return mixed
     */
    public function getContestsStatisticByStatus()
    {
        $contests = $this->repository->getAllItems([], ['status'], true)
            ->select(['status_id', DB::raw('count(*) as total')])
            ->groupBy('status_id')
            ->get();

        return $contests;
    }
}
