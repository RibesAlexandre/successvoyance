const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

var scripts = {
    toastr: './node_modules/toastr/toastr.js',
}

elixir(mix => {
    mix.sass('app.scss')
    .sass([
        'toastr.scss',
    ], 'public/css/components.css')
    .scripts([
        scripts.toastr,
    ], 'public/js/components.js')
    .webpack('app.js');
});
