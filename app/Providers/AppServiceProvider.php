<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tmdb\Exception\TmdbApiException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('film_exists', function ($attribute, $value, $parameters, $validator) {
            try{
                $data = app('Tmdb\Repository\MovieRepository')->getApi()->getMovie($value);
            } catch (TmdbApiException $e) {
                return false;
            }

            return is_array($data);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
