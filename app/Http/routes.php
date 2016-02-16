<?php


Route::get('test', function () {
    $genres = \App\Models\Genre::all();
    $genres = $genres->sortByDesc(function ($genre) {
        return $genre->films->filter(function ($film) {
            return (bool)$film->watched;
        })->count();
    });
    foreach ($genres as $genre) {
        echo sprintf('%s : %s <br>', $genre, $genre->films->filter(function ($film) {
            return (bool)$film->watched;
        })->count());
    }

});

Route::get('do-genres', function () {
    $films = \App\Models\Film::all();
    $dbGenres = [];
    foreach ($films as $film) {
        $genres = array_pluck($film->accessApi('genres'), 'name');
        foreach ($genres as $genre) {
            if (in_array($genre, array_keys($dbGenres))) {
                $film->genres()->attach($dbGenres[$genre]);
            } else {
                $dbGenre = App\Models\Genre::where('name', $genre)->first();

                if ($dbGenre) {
                    $dbGenres[$dbGenre->name] = $dbGenre;
                } else {
                    $dbGenre = App\Models\Genre::create(['name' => $genre]);
                    $dbGenres[$dbGenre->name] = $dbGenre;
                }

                $film->genres()->attach($dbGenre);
            }
        }
    }

});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'as'   => 'index',
        'uses' => 'SiteController@index'
    ]);

    Route::get('quick-add', [
        'as'   => 'quick-add',
        'uses' => 'SiteController@quickAdd'
    ]);

    Route::post('quick-add', [
        'as'   => 'quick-add-proc',
        'uses' => 'SiteController@quickAddProc'
    ]);
});
