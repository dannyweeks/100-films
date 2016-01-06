var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy('components/foundation/scss', 'resources/assets/sass/vendor/foundation');
    mix.copy('vendor/components/font-awesome/scss', 'resources/assets/sass/vendor/font-awesome');
    mix.copy('vendor/components/font-awesome/fonts', 'public/fonts');
    mix.copy('components/modernizr/modernizr.js', 'public/js/modernizr.js');
    mix.sass('app.scss');
    mix.scripts([
        './components/jquery/jquery.js',
        './components/foundation/js/foundation.js',
        'datatables.js',
        'datatables-anti-the.js',
        'datatables-date.js',
        'app.js'
    ]);
});
