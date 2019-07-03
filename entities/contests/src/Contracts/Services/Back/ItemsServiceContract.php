<?php

namespace InetStudio\ContestsPackage\Contests\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;

/**
 * Interface ItemsServiceContract.
 */
interface ItemsServiceContract extends BaseServiceContract
{
    /**
     * Сохраняем модель.
     *
     * @param  array  $data
     * @param  int  $id
     *
     * @return ContestModelContract
     */
    public function save(array $data, int $id): ContestModelContract;
}
