<?php

namespace InetStudio\ContestsPackage\Contests\Transformers\Back\Utility;

use InetStudio\AdminPanel\Base\Transformers\BaseTransformer;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

/**
 * Class SuggestionTransformer.
 */
class SuggestionTransformer extends BaseTransformer implements SuggestionTransformerContract
{
    /**
     * @var string
     */
    protected $type;

    /**
     * SuggestionTransformer constructor.
     *
     * @param  string  $type
     */
    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    /**
     * Трансформация данных.
     *
     * @param  ContestModelContract  $item
     *
     * @return array
     */
    public function transform(ContestModelContract $item): array
    {
        return ($this->type == 'autocomplete')
            ? [
                'value' => $item['title'],
                'data' => [
                    'id' => $item['id'],
                    'type' => get_class($item),
                    'title' => $item['title'],
                    'path' => parse_url($item['href'], PHP_URL_PATH),
                    'href' => $item['href'],
                ],
            ]
            : [
                'id' => $item['id'],
                'name' => $item['title'],
            ];
    }
}
