const elixir = require('laravel-elixir');

//require('laravel-elixir-vue-2');

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
	sweetalert: './node_modules/sweetalert/dist/sweetalert.min.js',
	pjax: './bower_components/jquery-pjax/jquery.pjax.js',
	//datetimepicker: './bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
	//moment: './bower_components/moment/min/moment.min.js',
	//moment_fr: './bower_components/moment/locale/fr.js'
}

elixir(function(mix) {
	mix
		//.sass('app.scss')
		/*
		.styles([
			'essentials.css',
			'layout.css',
			'header.css',
			'color.css',
			'shop.css'
		], 'public/css/app.css')
		*/
		.less([
			'app.less',
		], 'public/css/app.css')
		.sass([
			'components/*.scss',
			'components/**.scss',
		], 'public/css/components.css')
		.sass([
			'plugins/*/scss',
			'plugins/**.scss',
		], 'public/css/plugins.css')
		.scripts([
			//'components.js',
			scripts.toastr,
			scripts.sweetalert,
			//scripts.pjax,
		], 'public/js/components.js')
		.copy('resources/assets/imgs', 'public/imgs')
		.scripts([
			'actions.js',
			'components.js',
			'app.js'
		], 'public/js/app.js')
		.scripts([
			//'admin/bootstrap-checkbox-radio-switch.js',
			'admin/bootstrap-notify.js',
			'admin/bootstrap-select.js',
			'admin/chartist.min.js',
			'admin/light-bootstrap-dashboard.js'
		], 'public/js/admin.js')
		.scripts([
			//'plugins/moment.js',
			//'plugins/datetimepicker.js',
			'plugins/sumernote_fr.js',
		], 'public/js/plugins.js')
		.sass([
			'admin/light-bootstrap-dashboard.scss'
		], 'public/css/admin.css')
        .version([
            'css/app.css',
            'css/components.css',
            'js/components.js',
            'js/plugins.js',
            'js/app.js',
			'css/admin.css',
			//'css/plugins.css',
			'js/admin.js',
			'js/laroute.js'
        ])
	//.webpack('app.js');
});
