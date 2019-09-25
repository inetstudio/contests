<?php

namespace InetStudio\ContestsPackage\Contests\Transformers\Front\Sitemap;

use Carbon\Carbon;
use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Transformers\Front\Sitemap\ItemTransformerContract;

/**
 * Class ItemTransformer.
 */
class ItemTransformer extends BaseTransformer implements ItemTransformerContract
{
    /**
     * Подготовка данных для отображения в карте сайта.
     *
     * @param  ContestModelContract  $item
     *
     * @return array
     */
    public function transform(ContestModelContract $item): array
    {
        /** @var Carbon $updatedAt */
        $updatedAt = $item['updated_at'];

        return [
            'loc' => $item['href'],
            'lastmod' => $updatedAt->toW3cString(),
            'priority' => '1.0',
            'freq' => 'daily',
        ];
    }
}
