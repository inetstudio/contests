<?php

namespace InetStudio\Contests\Services\Front;

use League\Fractal\Manager;
use League\Fractal\Serializer\DataArraySerializer;
use InetStudio\Contests\Contracts\Services\Front\ContestsServiceContract;

/**
 * Class ContestsService.
 */
class ContestsService implements ContestsServiceContract
{
    /**
     * @var
     */
    public $repository;

    /**
     * ContestsService constructor.
     */
    public function __construct()
    {
        $this->repository = app()->make('InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract');
    }

    /**
     * Получаем объект по id.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getContestById(int $id = 0)
    {
        return $this->repository->getItemByID($id);
    }

    /**
     * Получаем объекты по id.
     *
     * @param $ids
     * @param array $params
     *
     * @return mixed
     */
    public function getContestsByIDs($ids, array $params = [])
    {
        return $this->repository->getItemsByIDs($ids, $params);
    }

    /**
     * Получаем объект по slug.
     *
     * @param string $slug
     * @param array $params
     *
     * @return mixed
     */
    public function getContestBySlug(string $slug, array $params = [])
    {
        return $this->repository->getItemBySlug($slug, $params);
    }

    /**
     * Получаем объекты по тегу.
     *
     * @param string $tagSlug
     * @param array $params
     *
     * @return mixed
     */
    public function getContestsByTag(string $tagSlug, array $params = [])
    {
        return $this->repository->getItemsByTag($tagSlug, $params);
    }

    /**
     * Получаем объекты по категории.
     *
     * @param string $categorySlug
     * @param array $params
     *
     * @return mixed
     */
    public function getContestsByCategory(string $categorySlug, array $params = [])
    {
        return $this->repository->getItemsByCategory($categorySlug, $params);
    }

    /**
     * Получаем объекты из категорий.
     *
     * @param $categories
     * @param array $params
     *
     * @return mixed
     */
    public function getContestsFromCategories($categories, array $params = [])
    {
        return $this->repository->getItemsFromCategories($categories, $params);
    }

    /**
     * Получаем сохраненные объекты пользователя.
     *
     * @param int $userID
     * @param array $params
     *
     * @return mixed
     */
    public function getContestsFavoritedByUser(int $userID, array $params = [])
    {
        return $this->repository->getItemsFavoritedByUser($userID, $params);
    }

    /**
     * Получаем все объекты.
     *
     * @param array $params
     *
     * @return mixed
     */
    public function getAllContests(array $params = [])
    {
        return $this->repository->getAllItems($params);
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
