<?php

namespace InetStudio\Contests\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;
use InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsUtilityControllerContract;

/**
 * Class ContestsUtilityController.
 */
class ContestsUtilityController extends Controller implements ContestsUtilityControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * ContestsUtilityController constructor.
     */
    public function __construct()
    {
        $this->services['contests'] = app()->make('InetStudio\Contests\Contracts\Services\Back\ContestsServiceContract');
    }

    /**
     * Получаем slug для модели по строке.
     *
     * @param Request $request
     *
     * @return SlugResponseContract
     */
    public function getSlug(Request $request): SlugResponseContract
    {
        $name = $request->get('name');
        $model = app()->make('InetStudio\Contests\Contracts\Models\ContestModelContract');

        $slug = ($name) ? SlugService::createSlug($model, 'slug', $name) : '';

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract', [
            'slug' => $slug,
        ]);
    }

    /**
     * Возвращаем статьи для поля.
     *
     * @param Request $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q');
        $type = $request->get('type');

        $data = $this->services['contests']->getSuggestions($search, $type);

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract', [
            'suggestions' => $data,
        ]);
    }
}
