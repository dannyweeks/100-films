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
                        {{--<div class="more">--}}
                        {{--<div class="row">--}}
                        {{--<div class="small-6 columns">--}}
                        {{--<img src="{{ $watchedFilm->image_url }}" alt=""/>--}}
                        {{--</div>--}}
                        {{--<div class="small-6 columns">--}}
                        {{--{{ $watchedFilm->description }}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
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