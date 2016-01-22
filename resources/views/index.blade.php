@extends('template.master')

@section('content')

    <div class="row">
        <div class="medium-6 medium-centered columns">
            <h2 class="text-center text-white">
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
        <li class="tabs-title is-active"><a href="#watched" aria-selected="true">Watched</a></li>
        <li class="tabs-title"><a href="#unwatched">To Watch</a></li>
        <li class="tabs-title"><a href="#stats">Stats</a></li>
    </ul>

    <div class="tabs-content" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="watched">
           @include('partials.watched')
        </div>
        <div class="tabs-panel" id="unwatched">
            @include('partials.unwatched')
        </div>
        </div>
        <div class="tabs-panel" id="stats">
            @include('partials.stats')
        </div>
    </div>
@endsection