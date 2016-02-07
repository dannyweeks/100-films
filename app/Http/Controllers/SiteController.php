<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuickAddRequest;
use App\Models\Film;
use App\Repositories\FilmRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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

        return view('index', compact('toWatch', 'watched', 'watchedThisYear'))
            ->with('mostControversial', $mostControversial)
            ->with('mostLoved', $this->films->mostLoved())
            ->with('mostHated', $this->films->mostHated())
            ->with('averageWatchedPerWeek', $this->films->averageWatchedPerWeek());
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

        return redirect()->to('/');

    }
}
