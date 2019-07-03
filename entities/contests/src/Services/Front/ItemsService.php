<?php

namespace InetStudio\ContestsPackage\Contests\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\AdminPanel\Base\Services\Traits\SlugsServiceTrait;
use InetStudio\Favorites\Services\Front\Traits\FavoritesServiceTrait;
use InetStudio\TagsPackage\Tags\Services\Front\Traits\TagsServiceTrait;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Services\Front\ItemsServiceContract;
use InetStudio\CategoriesPackage\Categories\Services\Front\Traits\CategoriesServiceTrait;

/**
 * Class ItemsService.
 */
class ItemsService extends BaseService implements ItemsServiceContract
{
    use TagsServiceTrait;
    use SlugsServiceTrait;
    use FavoritesServiceTrait;
    use CategoriesServiceTrait;

    /**
     * @var string
     */
    protected $favoritesType = 'contest';

    /**
     * ContestsService constructor.
     *
     * @param  ContestModelContract  $model
     */
    public function __construct(ContestModelContract $model)
    {
        parent::__construct($model);
    }
}
