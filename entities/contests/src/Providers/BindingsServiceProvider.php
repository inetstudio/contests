<?php

namespace InetStudio\ContestsPackage\Contests\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class BindingsServiceProvider.
 */
class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    /**
     * @var array
     */
    public $bindings = [
        'InetStudio\ContestsPackage\Contests\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\ContestsPackage\Contests\Events\Back\ModifyItemEvent',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\ContestsPackage\Contests\Http\Controllers\Back\ResourceController',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\ContestsPackage\Contests\Http\Controllers\Back\DataController',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\ContestsPackage\Contests\Http\Controllers\Back\UtilityController',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\ContestsPackage\Contests\Http\Requests\Back\SaveItemRequest',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Utility\SlugResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\ContestsPackage\Contests\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract' => 'InetStudio\ContestsPackage\Contests\Models\ContestModel',
        'InetStudio\ContestsPackage\Contests\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\ContestsPackage\Contests\Services\Back\DataTableService',
        'InetStudio\ContestsPackage\Contests\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\ContestsPackage\Contests\Services\Back\ItemsService',
        'InetStudio\ContestsPackage\Contests\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\ContestsPackage\Contests\Services\Back\UtilityService',
        'InetStudio\ContestsPackage\Contests\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\ContestsPackage\Contests\Services\Front\ItemsService',
        'InetStudio\ContestsPackage\Contests\Contracts\Services\Front\SitemapServiceContract' => 'InetStudio\ContestsPackage\Contests\Services\Front\SitemapService',
        'InetStudio\ContestsPackage\Contests\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\ContestsPackage\Contests\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\ContestsPackage\Contests\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\ContestsPackage\Contests\Transformers\Back\Utility\SuggestionTransformer',
        'InetStudio\ContestsPackage\Contests\Contracts\Transformers\Front\Sitemap\ItemTransformerContract' => 'InetStudio\ContestsPackage\Contests\Transformers\Front\Sitemap\ItemTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
