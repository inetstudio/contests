<?php

namespace InetStudio\Contests\Services\Front;

use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\AdminPanel\Services\Front\BaseService;
use InetStudio\TagsPackage\Tags\Services\Front\Traits\TagsServiceTrait;
use InetStudio\AdminPanel\Services\Front\Traits\SlugsServiceTrait;
use InetStudio\Favorites\Services\Front\Traits\FavoritesServiceTrait;
use InetStudio\Categories\Services\Front\Traits\CategoriesServiceTrait;
use InetStudio\Contests\Contracts\Services\Front\ContestsServiceContract;

/**
 * Class ContestsService.
 */
class ContestsService extends BaseService implements ContestsServiceContract
{
    use TagsServiceTrait;
    use SlugsServiceTrait;
    use FavoritesServiceTrait;
    use CategoriesServiceTrait;

    /**
     * ContestsService constructor.
     */
    public function __construct()
    {
        parent::__construct(app()->make('InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract'));
    }

    /**
     * Получаем информацию по ингредиентам для фида.
     *
     * @return array
     */
    public function getFeedItems(): array
    {
        $items = $this->repository->getItemsQuery([
                'columns' => ['title', 'description', 'content', 'publish_date'],
                'relations' => ['categories'],
                'order' => ['publish_date' => 'desc'],
                'paging' => [
                    'page' => 0,
                    'limit' => 500,
                ],
            ])
            ->whereNotNull('publish_date')
            ->get();

        $resource = app()->make('InetStudio\Contests\Contracts\Transformers\Front\ContestsFeedItemsTransformerContract')
            ->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        return $transformation['data'];
    }

    /**
     * Получаем информацию по конкурсам для карты сайта.
     *
     * @return array
     */
    public function getSiteMapItems(): array
    {
        $items = $this->repository->getAllItems([
            'columns' => ['created_at', 'updated_at'],
            'order' => ['created_at' => 'desc'],
        ]);

        $resource = app()->make('InetStudio\Contests\Contracts\Transformers\Front\ContestsSiteMapTransformerContract')
            ->transformCollection($items);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        $transformation = $manager->createData($resource)->toArray();

        return $transformation['data'];
    }
}
