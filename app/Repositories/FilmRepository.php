<?php

namespace App\Repositories;

use App\Models\Film;
use Weeks\Laravel\Repositories\BaseEloquentRepository;

class FilmRepository extends BaseEloquentRepository
{
    protected  $model = Film::class;

    public function getUnWatched()
    {
        return $this->model->watched(false)->get()->sortBy(function($item, $key){
            return preg_replace("/^[Tt]he\s/", '', $item->title);
        });
    }

    public function getWatched()
    {
        return $this->model->watched()->orderBy('watched_on')->get();
    }

    public function watchedThisYearTotal()
    {
        return $this->model->watched()->thisYear()->count();
    }

    public function mostControversial()
    {
        return $this->model
            ->watched()
            ->select(\DB::raw('*, (hel_score - dan_score) AS score_dif'))
            ->get()
            ->each(function(Film $film){
                if($film->score_dif < 0) {
                    $film->score_dif = $film->score_dif * -1;
                }
            })
            ->sortByDesc('score_dif')
            ->first();
    }

    public function mostLoved()
    {
        return $this->model
            ->watched()
            ->select(\DB::raw('*, hel_score + dan_score AS score_total'))
            ->orderBy('score_total', 'DESC')
            ->first();
    }

    public function mostHated()
    {
        return $this->model
            ->watched()
            ->select(\DB::raw('*, hel_score + dan_score AS score_total'))
            ->orderBy('score_total', 'ASC')
            ->first();
    }
}