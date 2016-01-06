@extends('template.master')

@section('content')

    <div class="row">
        <div class="medium-6 medium-centered columns">
            <form action="/quick-add" method="POST">
                @if (count($errors) > 0)
                    <div class="alert callout" data-closable>
                        @foreach ($errors->all() as $error)
                            <p>
                                {{ $error }}
                            </p>
                        @endforeach
                        <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {!! csrf_field() !!}
                <label for="imdb_id">IMDB ID</label>
                <input type="text" name="imdb_id" autocomplete="off" value="{{ Request::old('imdb_id') }}" id="imdb_id"/>

                <label for="passcode">Top Secret Passcode</label>
                <input type="password" name="passcode" value="{{ Request::old('passcode') }}" id="passcode"/>

                <input type="submit" value="Add" class="button"/>

            </form>

        </div>
    </div>

@endsection