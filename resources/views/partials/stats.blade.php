<div class="row small-up-1 medium-up-3">

    @include('partials.stat-film', ['title' => 'Most Loved', 'film' => $mostLoved])
    @include('partials.stat-film', ['title' => 'Most Hated', 'film' => $mostHated])
    @include('partials.stat-film', ['title' => 'Most Controversial', 'film' => $mostControversial])
    <div class="column">
        <div class="callout text-center">
            <h2>Average Watched Per Week</h2>

            <h3 class="">
                {{ $averageWatchedPerWeek }}
            </h3>

            <p>
                Target per week to succeed: 100 / 52 = {{ number_format(100 / 52, 1) }}
            </p>
        </div>
    </div>
</div>