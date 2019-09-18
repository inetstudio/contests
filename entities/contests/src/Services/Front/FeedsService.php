<?php

namespace InetStudio\ContestsPackage\Contests\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Services\Front\FeedsServiceContract;

/**
 * Class FeedsService.
 */
class FeedsService extends BaseService implements FeedsServiceContract
{
    /**
     * FeedsService constructor.
     *
     * @param  ContestModelContract  $model
     */
    public function __construct(ContestModelContract $model)
    {
        parent::__construct($model);
    }
}
