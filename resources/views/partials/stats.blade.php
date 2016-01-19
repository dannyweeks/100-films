<div class="row small-up-1 medium-up-3">

    @include('partials.stat-film', ['title' => 'Most Loved', 'film' => $mostLoved])
    @include('partials.stat-film', ['title' => 'Most Hated', 'film' => $mostHated])
    @include('partials.stat-film', ['title' => 'Most Controversial', 'film' => $mostControversial])

</div>