<?php

namespace InetStudio\Contests\Repositories;

use InetStudio\AdminPanel\Repositories\BaseRepository;
use InetStudio\Tags\Repositories\Traits\TagsRepositoryTrait;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Favorites\Repositories\Traits\FavoritesRepositoryTrait;
use InetStudio\Categories\Repositories\Traits\CategoriesRepositoryTrait;
use InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract;

/**
 * Class ContestsRepository.
 */
class ContestsRepository extends BaseRepository implements ContestsRepositoryContract
{
    use TagsRepositoryTrait;
    use FavoritesRepositoryTrait;
    use CategoriesRepositoryTrait;

    /**
     * @var string
     */
    protected $favoritesType = 'contest';

    /**
     * ContestsRepository constructor.
     *
     * @param ContestModelContract $model
     */
    public function __construct(ContestModelContract $model)
    {
        $this->model = $model;

        $this->defaultColumns = ['id', 'title', 'slug'];
        $this->relations = [
            'access' => function ($query) {
                $query->select(['accessable_id', 'accessable_type', 'field', 'access']);
            },

            'meta' => function ($query) {
                $query->select(['metable_id', 'metable_type', 'key', 'value']);
            },

            'media' => function ($query) {
                $query->select(['id', 'model_id', 'model_type', 'collection_name', 'file_name', 'disk', 'custom_properties']);
            },

            'tags' => function ($query) {
                $query->select(['id', 'name', 'slug']);
            },

            'categories' => function ($query) {
                $query->select(['id', 'parent_id', 'name', 'slug', 'title', 'description'])->whereNotNull('parent_id');
            },

            'counters' => function ($query) {
                $query->select(['countable_id', 'countable_type', 'type', 'counter']);
            },

            'status' => function ($query) {
                $query->select(['id', 'name', 'alias', 'color_class']);
            },
        ];
    }

    /**
     * Получаем объекты по slug.
     *
     * @param string $slug
     * @param array $params
     *
     * @return mixed
     */
    public function getItemBySlug(string $slug, array $params = [])
    {
        $builder = $this->getItemsQuery($params)
            ->whereSlug($slug);

        $item = $builder->first();

        return $item;
    }
}
