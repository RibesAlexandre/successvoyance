const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/**
 * Sass Files
 */
mix
	.sass('resources/assets/sass/components/images.scss', 'public/css/components/images.css')
	.sass('resources/assets/sass/components/toastr.scss', 'public/css/components/toastr.css')
	.sass('resources/assets/sass/components/sweetalert.scss', 'public/css/components/sweetalert.css')
	.combine([
		'public/css/components/images.css',
		'public/css/components/toastr.css',
		'public/css/components/sweetalert.css'
	], 'public/css/components.css')
	.version();

/**
 * JS Files
 */
/*
mix.js('bower_components/toastr/toastr.js', 'public/js/plugins/toastr.js');
mix.js('bower_components/sweetalert/dist/sweetalert.min.js', 'public/js/plugins/sweetalert.js');
mix.combine([
	'public/js/plugins/sweetalert.js',
	'public/js/plugins/toastr.js'
], 'public/js/plugins.js').version();
*/
