<?php

namespace InetStudio\ContestsPackage\Contests\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Services\Back\ItemsServiceContract;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    /**
     * ItemsService constructor.
     *
     * @param  ContestModelContract  $model
     */
    public function __construct(ContestModelContract $model)
    {
        parent::__construct($model);
    }

    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return ContestModelContract
     *
     * @throws BindingResolutionException
     */
    public function save(array $data, int $id): ContestModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        $metaData = Arr::get($data, 'meta', []);
        app()->make('InetStudio\MetaPackage\Meta\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($metaData, $item);

        $images = (config('contests.images.conversions.'.$item->material_type)) ? array_keys(config('contests.images.conversions.'.$item->material_type)) : [];
        app()->make('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract')
            ->attachToObject(request(), $item, $images, 'contests', $item->material_type);
        app()->make('InetStudio\Uploads\Contracts\Services\Back\FilesServiceContract')
            ->attachToObject($item, ['rules'], 'contests');

        $tagsData = Arr::get($data, 'tags', []);
        app()->make('InetStudio\TagsPackage\Tags\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($tagsData, $item);

        $categoriesData = Arr::get($data, 'categories', []);
        app()->make('InetStudio\CategoriesPackage\Categories\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($categoriesData, $item);

        $fieldsAccessData = Arr::get($data, 'access.fields', []);
        app()->make('InetStudio\AccessPackage\Fields\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($fieldsAccessData, $item);

        resolve('InetStudio\WidgetsPackage\Widgets\Contracts\Actions\Back\AttachWidgetsToObjectActionContract')
            ->execute(
                resolve(
                    'InetStudio\WidgetsPackage\Widgets\Contracts\DTO\Actions\Back\AttachWidgetsToObjectDataContract',
                    [
                        'args' => [
                            'item' => $item,
                            'widgets' => explode(',', request()->get('widgets'))
                        ],
                    ]
                )
            );

        $item->searchable();

        event(
            app()->makeWith(
                'InetStudio\ContestsPackage\Contests\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Конкурс «'.$item->title.'» успешно '.$action);

        return $item;
    }

    /**
     * Возвращаем статистику конкурсов по статусу.
     *
     * @return mixed
     */
    public function getItemsStatisticByStatus()
    {
        $items = $this->model::buildQuery(
                [
                    'relations' => ['status'],
                ]
            )
            ->select(['status_id', DB::raw('count(*) as total')])
            ->groupBy('status_id')
            ->get();

        return $items;
    }
}
