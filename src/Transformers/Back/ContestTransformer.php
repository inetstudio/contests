<?php

namespace InetStudio\Contests\Transformers\Back;

use League\Fractal\TransformerAbstract;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Transformers\Back\ContestTransformerContract;

/**
 * Class ContestTransformer.
 */
class ContestTransformer extends TransformerAbstract implements ContestTransformerContract
{
    /**
     * Подготовка данных для отображения в таблице.
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
            'id' => (int) $item->id,
            'title' => $item->title,
            'status' => view('admin.module.contests::back.partials.datatables.status', [
                'status' => $item->status,
            ])->render(),
            'created_at' => (string) $item->created_at,
            'updated_at' => (string) $item->updated_at,
            'publish_date' => (string) $item->publish_date,
            'actions' => view('admin.module.contests::back.partials.datatables.actions', [
                'id' => $item->id,
                'href' => $item->href,
            ])->render(),
        ];
    }
}
