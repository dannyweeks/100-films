<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>100 Films, 1 Year...</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="css/app.css">
    <script src="js/modernizr.js"></script>
</head>
<body>
<h1 class="text-center">
    One Hundred Films, One Year
</h1>

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
                                ( {!! sprintf('<a href="http://imdb.com/title/%s">IMDB</a>', $unwatchedFilm->imdb_id) !!} )
                            </small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="js/all.js"></script>
</body>
</html>