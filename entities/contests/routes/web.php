<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\ContestsPackage\Contests\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back',
    ],
    function () {
        Route::any('contests/data', 'DataControllerContract@data')
            ->name('back.contests.data.index');

        Route::post('contests/slug', 'UtilityControllerContract@getSlug')
            ->name('back.contests.getSlug');

        Route::post('contests/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.contests.getSuggestions');

        Route::resource('contests', 'ResourceControllerContract', ['as' => 'back']);
    }
);
