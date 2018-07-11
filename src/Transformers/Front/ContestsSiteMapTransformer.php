<?php

namespace InetStudio\Contests\Transformers\Front;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Transformers\Front\ContestsSiteMapTransformerContract;

/**
 * Class ContestsSiteMapTransformer.
 */
class ContestsSiteMapTransformer extends TransformerAbstract implements ContestsSiteMapTransformerContract
{
    /**
     * Подготовка данных для отображения в карте сайта.
     *
     * @param ContestModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(ContestModelContract $item): array
    {
        return [
            'loc' => $item->href,
            'lastmod' => $item->updated_at->toW3cString(),
            'priority' => '1.0',
            'freq' => 'daily',
        ];
    }

    /**
     * Обработка коллекции статей.
     *
     * @param $items
     *
     * @return FractalCollection
     */
    public function transformCollection($items): FractalCollection
    {
        return new FractalCollection($items, $this);
    }
}
