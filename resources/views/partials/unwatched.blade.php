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