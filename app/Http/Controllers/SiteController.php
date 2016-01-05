<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $toWatch = Film::watched(false)->get();
        $watched = Film::watched()->orderBy('watched_on')->get();
        $watchedThisYear = Film::watched()->thisYear()->count();

        return view('index', compact('toWatch', 'watched', 'watchedThisYear'));
    }
}
