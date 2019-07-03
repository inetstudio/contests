<?php

namespace InetStudio\ContestsPackage\Contests\Contracts\Transformers\Back\Resource;

use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;

/**
 * Interface IndexTransformerContract.
 */
interface IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param  ContestModelContract  $item
     *
     * @return array
     */
    public function transform(ContestModelContract $item): array;
}
