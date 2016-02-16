<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuickAddRequest;
use App\Models\Film;
use App\Models\Genre;
use App\Repositories\FilmRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Tmdb\Exception\TmdbApiException;
use Tmdb\Repository\MovieRepository;

class SiteController extends Controller
{
    /**
     * @var FilmRepository
     */
    private $films;

    /**
     * @param FilmRepository $films
     */
    public function __construct(FilmRepository $films)
    {

        $this->films = $films;
    }

    public function index()
    {
        $toWatch = $this->films->getUnWatched();

        $watched = $this->films->getWatched();
        $watchedThisYear = $this->films->watchedThisYearTotal();
        $mostControversial = $this->films->mostControversial();

        $genres = \App\Models\Genre::all();

        $genres = $genres->sortByDesc(function ($genre) {
            return $genre->films->filter(function ($film) {
                return (bool)$film->watched;
            })->count();
        })->transform(function ($genre) {
            $format = "<tr><td>%s</td><td>%s</td></tr>";
            /** @var Collection $films */
            $films = $genre->films->filter(function ($film) {
                return (bool)$film->watched;
            })->transform(function ($film) {
                $newFilm = [];
                $newFilm['title'] = $film->title;
                $newFilm['background_image'] = $film->background_image;

                return $newFilm;
            })->sortBy('title');
            $filmsEncoded = json_encode(array_values($films->toArray()));

            return sprintf($format, $genre, $films->count());
        });

        return view('index', compact('toWatch', 'watched', 'watchedThisYear'))
            ->with('mostControversial', $mostControversial)
            ->with('mostLoved', $this->films->mostLoved())
            ->with('mostHated', $this->films->mostHated())
            ->with('averageWatchedPerWeek', $this->films->averageWatchedPerWeek())
            ->with('genrePopularity', $genres);
    }

    public function quickAdd()
    {
        return view('quick-add');
    }

    public function quickAddProc(QuickAddRequest $request, MovieRepository $movieRepository)
    {

        $data = $movieRepository->getApi()->getMovie($request->get('imdb_id'));

        $film = new Film();
        $film->title = $data['title'];
        $film->imdb_id = $data['imdb_id'];
        $film->save();

        $genres = array_pluck($film->accessApi('genres'), 'name');
        foreach ($genres as $genre) {

            $dbGenre = Genre::where('name', $genre)->first();

            if ($dbGenre) {
                $dbGenres[$dbGenre->name] = $dbGenre;
            } else {
                $dbGenre = Genre::create(['name' => $genre]);
                $dbGenres[$dbGenre->name] = $dbGenre;
            }

            $film->genres()->attach($dbGenre);

        }

        return redirect()->to('/');

    }
}
