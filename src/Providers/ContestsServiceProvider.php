<?php

namespace InetStudio\Contests\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContestsServiceProvider.
 */
class ContestsServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerObservers();
    }

    /**
     * Регистрация привязки в контейнере.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerBindings();
    }

    /**
     * Регистрация команд.
     *
     * @return void
     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                'InetStudio\Contests\Console\Commands\SetupCommand',
                'InetStudio\Contests\Console\Commands\CreateFoldersCommand',
            ]);
        }
    }

    /**
     * Регистрация ресурсов.
     *
     * @return void
     */
    protected function registerPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../config/contests.php' => config_path('contests.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../../config/filesystems.php', 'filesystems.disks'
        );

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateContestsTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_contests_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_contests_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Регистрация путей.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.
     *
     * @return void
     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.contests');
    }

    /**
     * Регистрация наблюдателей.
     *
     * @return void
     */
    public function registerObservers(): void
    {
        $this->app->make('InetStudio\Contests\Contracts\Models\ContestModelContract')::observe($this->app->make('InetStudio\Contests\Contracts\Observers\ContestObserverContract'));
    }

    /**
     * Регистрация привязок, алиасов и сторонних провайдеров сервисов.
     *
     * @return void
     */
    protected function registerBindings(): void
    {
        // Controllers
        $this->app->bind('InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsControllerContract', 'InetStudio\Contests\Http\Controllers\Back\ContestsController');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsDataControllerContract', 'InetStudio\Contests\Http\Controllers\Back\ContestsDataController');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsUtilityControllerContract', 'InetStudio\Contests\Http\Controllers\Back\ContestsUtilityController');

        // Events
        $this->app->bind('InetStudio\Contests\Contracts\Events\Back\ModifyContestEventContract', 'InetStudio\Contests\Events\Back\ModifyContestEvent');

        // Models
        $this->app->bind('InetStudio\Contests\Contracts\Models\ContestModelContract', 'InetStudio\Contests\Models\ContestModel');

        // Observers
        $this->app->bind('InetStudio\Contests\Contracts\Observers\ContestObserverContract', 'InetStudio\Contests\Observers\ContestObserver');

        // Repositories
        $this->app->bind('InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract', 'InetStudio\Contests\Repositories\ContestsRepository');

        // Requests
        $this->app->bind('InetStudio\Contests\Contracts\Http\Requests\Back\SaveContestRequestContract', 'InetStudio\Contests\Http\Requests\Back\SaveContestRequest');

        // Responses
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\DestroyResponseContract', 'InetStudio\Contests\Http\Responses\Back\Contests\DestroyResponse');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\FormResponseContract', 'InetStudio\Contests\Http\Responses\Back\Contests\FormResponse');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\IndexResponseContract', 'InetStudio\Contests\Http\Responses\Back\Contests\IndexResponse');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\SaveResponseContract', 'InetStudio\Contests\Http\Responses\Back\Contests\SaveResponse');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\ShowResponseContract', 'InetStudio\Contests\Http\Responses\Back\Contests\ShowResponse');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract', 'InetStudio\Contests\Http\Responses\Back\Utility\SlugResponse');
        $this->app->bind('InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', 'InetStudio\Contests\Http\Responses\Back\Utility\SuggestionsResponse');

        // Services
        $this->app->bind('InetStudio\Contests\Contracts\Services\Back\ContestsDataTableServiceContract', 'InetStudio\Contests\Services\Back\ContestsDataTableService');
        $this->app->bind('InetStudio\Contests\Contracts\Services\Back\ContestsObserverServiceContract', 'InetStudio\Contests\Services\Back\ContestsObserverService');
        $this->app->bind('InetStudio\Contests\Contracts\Services\Back\ContestsServiceContract', 'InetStudio\Contests\Services\Back\ContestsService');
        $this->app->bind('InetStudio\Contests\Contracts\Services\Front\ContestsServiceContract', 'InetStudio\Contests\Services\Front\ContestsService');

        // Transformers
        $this->app->bind('InetStudio\Contests\Contracts\Transformers\Back\ContestTransformerContract', 'InetStudio\Contests\Transformers\Back\ContestTransformer');
        $this->app->bind('InetStudio\Contests\Contracts\Transformers\Back\SuggestionTransformerContract', 'InetStudio\Contests\Transformers\Back\SuggestionTransformer');
        $this->app->bind('InetStudio\Contests\Contracts\Transformers\Front\ContestsFeedItemsTransformerContract', 'InetStudio\Contests\Transformers\Front\ContestsFeedItemsTransformer');
        $this->app->bind('InetStudio\Contests\Contracts\Transformers\Front\ContestsSiteMapTransformerContract', 'InetStudio\Contests\Transformers\Front\ContestsSiteMapTransformer');
    }
}
