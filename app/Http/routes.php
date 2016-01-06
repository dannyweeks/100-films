<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'as'   => 'index',
        'uses' => 'SiteController@index'
    ]);

    Route::get('quick-add', [
        'as' => 'quick-add',
        'uses' => 'SiteController@quickAdd'
    ]);

    Route::post('quick-add', [
        'as' => 'quick-add-proc',
        'uses' => 'SiteController@quickAddProc'
    ]);
});
