<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuickAddRequest;
use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tmdb\Exception\TmdbApiException;
use Tmdb\Repository\MovieRepository;

class SiteController extends Controller
{
    public function index()
    {
        $toWatch = Film::watched(false)->get();
        $watched = Film::watched()->orderBy('watched_on')->get();
        $watchedThisYear = Film::watched()->thisYear()->count();

        return view('index', compact('toWatch', 'watched', 'watchedThisYear'));
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
