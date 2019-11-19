<?php

Route::group(['middleware' => 'auth:api'], function() {
    
    Route::get('stats/counters', 'Http\Controllers\Api\StatsController@counters');

    Route::resource('stats', 'Http\Controllers\Api\StatsController', [
        'except' => [ 'index', 'create', 'edit' ]
    ]);
});
