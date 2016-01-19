<div class="column">
    <div class="callout film" data-bg-image="{{ $film->background_image }}">
        <div class="row">
            <h2 class="text-center">{{ $title }}</h2>
            <div class="small-4 columns">
                <img class="thumbnail" src="{{ $film->image_url }}" alt="{{ $film->title }} dvd cover"/>
            </div>
            <div class="small-8 columns">
                <h3>
                    {{ $film->title }}
                </h3>
                <table class="text-center">
                    <thead>
                    <tr>
                        <th>Helen</th>
                        <th>Danny</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $film->hel_score }}</td>
                        <td>{{ $film->dan_score }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>