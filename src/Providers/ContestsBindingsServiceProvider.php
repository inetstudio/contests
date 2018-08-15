<?php

namespace InetStudio\Contests\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContestsBindingsServiceProvider.
 */
class ContestsBindingsServiceProvider extends ServiceProvider
{
    /**
    * @var  bool
    */
    protected $defer = true;

    /**
    * @var  array
    */
    public $bindings = [
        'InetStudio\Contests\Contracts\Events\Back\ModifyContestEventContract' => 'InetStudio\Contests\Events\Back\ModifyContestEvent',
        'InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsControllerContract' => 'InetStudio\Contests\Http\Controllers\Back\ContestsController',
        'InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsDataControllerContract' => 'InetStudio\Contests\Http\Controllers\Back\ContestsDataController',
        'InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsUtilityControllerContract' => 'InetStudio\Contests\Http\Controllers\Back\ContestsUtilityController',
        'InetStudio\Contests\Contracts\Http\Requests\Back\SaveContestRequestContract' => 'InetStudio\Contests\Http\Requests\Back\SaveContestRequest',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Contests\DestroyResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Contests\DestroyResponse',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Contests\FormResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Contests\FormResponse',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Contests\IndexResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Contests\IndexResponse',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Contests\SaveResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Contests\SaveResponse',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Contests\ShowResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Contests\ShowResponse',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Utility\SlugResponse',
        'InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\Contests\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\Contests\Contracts\Models\ContestModelContract' => 'InetStudio\Contests\Models\ContestModel',
        'InetStudio\Contests\Contracts\Observers\ContestObserverContract' => 'InetStudio\Contests\Observers\ContestObserver',
        'InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract' => 'InetStudio\Contests\Repositories\ContestsRepository',
        'InetStudio\Contests\Contracts\Services\Back\ContestsDataTableServiceContract' => 'InetStudio\Contests\Services\Back\ContestsDataTableService',
        'InetStudio\Contests\Contracts\Services\Back\ContestsObserverServiceContract' => 'InetStudio\Contests\Services\Back\ContestsObserverService',
        'InetStudio\Contests\Contracts\Services\Back\ContestsServiceContract' => 'InetStudio\Contests\Services\Back\ContestsService',
        'InetStudio\Contests\Contracts\Services\Front\ContestsServiceContract' => 'InetStudio\Contests\Services\Front\ContestsService',
        'InetStudio\Contests\Contracts\Transformers\Back\ContestTransformerContract' => 'InetStudio\Contests\Transformers\Back\ContestTransformer',
        'InetStudio\Contests\Contracts\Transformers\Back\SuggestionTransformerContract' => 'InetStudio\Contests\Transformers\Back\SuggestionTransformer',
        'InetStudio\Contests\Contracts\Transformers\Front\ContestsFeedItemsTransformerContract' => 'InetStudio\Contests\Transformers\Front\ContestsFeedItemsTransformer',
        'InetStudio\Contests\Contracts\Transformers\Front\ContestsSiteMapTransformerContract' => 'InetStudio\Contests\Transformers\Front\ContestsSiteMapTransformer',
    ];

    /**
     * Получить сервисы от провайдера.
     *
     * @return  array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
