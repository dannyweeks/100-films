<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'as'   => 'index',
        'uses' => 'SiteController@index'
    ]);
});
