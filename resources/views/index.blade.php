@extends('template.master')

@section('content')

    <div class="row">
        <div class="medium-6 medium-centered columns">
            <h2 class="text-center">
                This Year's Total...
            </h2>
            <div class="total">
                <div class="text-center">
                    {{ $watchedThisYear }}
                </div>
            </div>
        </div>
    </div>

    <ul class="tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Watched</a></li>
        <li class="tabs-title"><a href="#panel2">To Watch</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1">

            <div class="row">
                <div class="medium-9 medium-centered columns text-center">

                    <table id="watched-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date Watched</th>
                            <th>Hel's Score</th>
                            <th>Dan's Score</th>
                            <th>Average Score</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($watched as $watchedFilm)
                            <tr class="film" data-bg-image="{{ $watchedFilm->background_image }}">
                                <td>
                                    {{ $watchedFilm->title }}
                                </td>
                                <td>
                                    {{ $watchedFilm->date_watched }}
                                </td>
                                <td>
                                    {{ $watchedFilm->hel_score }}
                                </td>
                                <td>
                                    {{ $watchedFilm->dan_score }}
                                </td>
                                <td>
                                    {{ $watchedFilm->average_score }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <td></td>
                            <td class="text-center">
                                Averages
                            </td>
                            <td class="text-center">
                                {{ number_format($watched->sum('hel_score') / $watched->count(), 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($watched->sum('dan_score') / $watched->count(), 2) }}
                            </td>
                            <td class="text-center">
                                {{ number_format($watched->sum('average_score') / $watched->count(), 2) }}
                            </td>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
        <div class="tabs-panel" id="panel2">
            <div class="row">
                <div class="medium-6 medium-centered columns">
                    <ul class="list">
                        @foreach($toWatch as $unwatchedFilm)
                            <li class="film" data-bg-image="{{ $unwatchedFilm->background_image }}">
                                {{ $unwatchedFilm->title }}
                                <small>
                                    ( <a href="http://imdb.com/title/{{ $unwatchedFilm->imdb_id }}" target="_blank">IMDB</a> )
                                </small>
                            </li>

                        @endforeach
                        <li class="text-right">
                            total {{ $toWatch->count() }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection