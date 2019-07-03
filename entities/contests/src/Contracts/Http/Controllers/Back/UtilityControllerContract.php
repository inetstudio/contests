<?php

namespace InetStudio\ContestsPackage\Contests\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\ContestsPackage\Contests\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\ContestsPackage\Contests\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

/**
 * Interface UtilityControllerContract.
 */
interface UtilityControllerContract
{
    /**
     * Получаем slug для модели по строке.
     *
     * @param  ItemsServiceContract  $itemsService
     * @param  Request  $request
     *
     * @return SlugResponseContract
     */
    public function getSlug(ItemsServiceContract $itemsService, Request $request): SlugResponseContract;

    /**
     * Возвращаем объекты для поля.
     *
     * @param  UtilityServiceContract  $utilityService
     * @param  Request  $request
     *
     * @return SuggestionsResponseContract
     */
    public function getSuggestions(UtilityServiceContract $utilityService, Request $request): SuggestionsResponseContract;
}
