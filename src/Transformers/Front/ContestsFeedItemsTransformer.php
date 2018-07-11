<?php

namespace InetStudio\Contests\Transformers\Front;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Transformers\Front\ContestsFeedItemsTransformerContract;

/**
 * Class ContestsFeedItemsTransformer.
 */
class ContestsFeedItemsTransformer extends TransformerAbstract implements ContestsFeedItemsTransformerContract
{
    /**
     * Подготовка данных для отображения в фиде.
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
            'title' => $item->title,
            'author' => $this->getAuthor($item),
            'link' => $item->href,
            'pubdate' => $item->publish_date,
            'description' => $item->description,
            'content' => $item->content,
            'enclosure' => [],
            'category' => ($item->categories->count() > 0) ? $item->categories->first()->title : '',
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

    /**
     * Получаем автора статьи.
     *
     * @param ContestModelContract $item
     *
     * @return string
     */
    private function getAuthor(ContestModelContract $item): string
    {
        foreach ($item->revisionHistory as $history) {
            if ($history->key == 'created_at' && ! $history->old_value) {
                $user = $history->userResponsible();

                return ($user) ? $user->name : '';
            }
        }

        return '';
    }
}
