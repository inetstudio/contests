<?php

namespace InetStudio\Contests\Transformers\Back;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Transformers\Back\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends TransformerAbstract implements SuggestionTransformerContract
{
    /**
     * @var
     */
    private $type;

    /**
     * SuggestionTransformer constructor.
     *
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Подготовка данных для отображения в выпадающих списках.
     *
     * @param ContestModelContract $item
     *
     * @return array
     *
     * @throws \Throwable
     */
    public function transform(ContestModelContract $item): array
    {
        if ($this->type && $this->type == 'autocomplete') {
            $modelClass = get_class($item);

            return [
                'value' => $item->title,
                'data' => [
                    'id' => $item->id,
                    'type' => $modelClass,
                    'title' => $item->title,
                    'path' => parse_url($item->href, PHP_URL_PATH),
                    'href' => $item->href,
                ],
            ];
        } else {
            return [
                'id' => $item->id,
                'name' => $item->title,
            ];
        }
    }

    /**
     * Обработка коллекции объектов.
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
