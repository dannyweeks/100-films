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

    // Relationships
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
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

    public function getDescriptionAttribute()
    {
        return $this->accessApi('overview');
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

    public function getBackgroundImageIsDarkAttribute()
    {

    }

    protected function backgroundImageIsDark($num_samples = 100)
    {
        $img = imagecreatefromjpeg($this->background_image);

        $width = imagesx($img);
        $height = imagesy($img);

        $x_step = intval($width / $num_samples);
        $y_step = intval($height / $num_samples);

        $total_lum = 0;

        $sample_no = 1;

        for ($x = 0; $x < $width; $x += $x_step) {
            for ($y = 0; $y < $height; $y += $y_step) {

                $rgb = imagecolorat($img, $x, $y);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // choose a simple luminance formula from here
                // http://stackoverflow.com/questions/596216/formula-to-determine-brightness-of-rgb-color
                $lum = ($r + $r + $b + $g + $g + $g) / 6;

                $total_lum += $lum;

                // debugging code
                //           echo "$sample_no - XY: $x,$y = $r, $g, $b = $lum<br />";
                $sample_no++;
            }
        }

        // work out the average
        $avg_lum = $total_lum / $sample_no;

        return $avg_lum <= 170;
    }
}
