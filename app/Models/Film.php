<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{

    protected $dates = ['watched_on'];
    public function accessApi($fetch = null)
    {
        $data = app('Tmdb\Repository\MovieRepository')->getApi()->getMovie($this->imdb_id);

        if (!is_null($fetch)) {
            return $data[$fetch];
        }

        return $data;
    }

    // Scopes
    public function scopeWatched($query, $isWatched = true)
    {
        return $query->whereWatched($isWatched);
    }

    public function scopeThisYear($query)
    {
        return $query->whereBetween('watched_on', [Carbon::today()->startOfYear(), Carbon::today()->endOfYear()]);
    }

    // Accessors

    public function getTitleAttribute()
    {
        return $this->accessApi('title');
    }

    public function getImageUrlAttribute()
    {
        return app('Tmdb\Helper\ImageHelper')->getUrl($this->accessApi('poster_path'));
    }

    public function getImdbScoreAttribute()
    {
        return $this->accessApi('vote_average');
    }

    public function getOverviewAttribute()
    {
        return $this->accessApi('overview');
    }

    public function getAverageScoreAttribute()
    {
        return !$this->watched ? null : number_format(($this->hel_score + $this->dan_score) / 2, 1);
    }

    public function getDateAddedAttribute()
    {
        return $this->created_at->format('jS M \'y');
    }

    public function getDateWatchedAttribute()
    {
        return $this->watched_on->format('d/m/Y');
    }

    public function getBackgroundImageAttribute()
    {
        return app('Tmdb\Helper\ImageHelper')->getUrl($this->accessApi('backdrop_path'));
    }
}
