<?php

namespace InetStudio\ContestsPackage\Contests\Contracts\Transformers\Front\Sitemap;

use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;

/**
 * Interface ItemTransformerContract.
 */
interface ItemTransformerContract
{
    /**
     * Подготовка данных для отображения в карте сайта.
     *
     * @param  ContestModelContract  $item
     *
     * @return array
     */
    public function transform(ContestModelContract $item): array;

    /**
     * Обработка коллекции статей.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection;
}
