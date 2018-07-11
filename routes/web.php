<?php

Route::group([
    'namespace' => 'InetStudio\Contests\Contracts\Http\Controllers\Back',
    'middleware' => ['web', 'back.auth'],
    'prefix' => 'back',
], function () {
    Route::any('contests/data', 'ContestsDataControllerContract@data')->name('back.contests.data.index');
    Route::post('contests/slug', 'ContestsUtilityControllerContract@getSlug')->name('back.contests.getSlug');
    Route::post('contests/suggestions', 'ContestsUtilityControllerContract@getSuggestions')->name('back.contests.getSuggestions');

    Route::resource('contests', 'ContestsControllerContract', ['as' => 'back']);
});
