<?php

namespace InetStudio\ContestsPackage\Contests\Transformers\Back\Resource;

use Throwable;
use League\Fractal\TransformerAbstract;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Transformers\Back\Resource\IndexTransformerContract;

/**
 * Class IndexTransformer.
 */
class IndexTransformer extends TransformerAbstract implements IndexTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
     *
     * @param  ContestModelContract  $item
     *
     * @return array
     *
     * @throws Throwable
     */
    public function transform(ContestModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'title' => $item['title'],
            'status' => view(
                'admin.module.contests::back.partials.datatables.status',
                [
                    'status' => $item['status'],
                ]
            )->render(),
            'created_at' => (string) $item['created_at'],
            'updated_at' => (string) $item['updated_at'],
            'publish_date' => (string) $item['publish_date'],
            'actions' => view(
                'admin.module.contests::back.partials.datatables.actions',
                [
                    'id' => $item['id'],
                    'href' => $item['href'],
                ]
            )->render(),
        ];
    }
}
