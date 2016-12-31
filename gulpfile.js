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
	sweetalert: './node_modules/sweetalert/dist/sweetalert-dev.js',
}

elixir(function(mix) {
	mix.sass('app.scss')
		.sass([
			'components/toastr.scss',
			'components/sweetalert.scss',
		], 'public/css/components.css')
		.scripts([
			//'components.js',
			scripts.toastr,
			scripts.sweetalert,
		], 'public/js/components.js')
		.copy('resources/assets/imgs', 'public/imgs')
		.scripts([
			'app.js'
		], 'public/js/app.js')
		.scripts([
			//'admin/bootstrap-checkbox-radio-switch.js',
			'admin/bootstrap-notify.js',
			'admin/bootstrap-select.js',
			'admin/chartist.min.js',
			'admin/light-bootstrap-dashboard.js'
		], 'public/js/admin.js')
		.sass([
			'admin/light-bootstrap-dashboard.scss'
		], 'public/css/admin.css')
        .version([
            'css/app.css',
            'css/components.css',
            'js/components.js',
            'js/app.js',
			'css/admin.css',
			'js/admin.js'
        ])
	//.webpack('app.js');
});
