
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

/*
Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
*/

var app = {
	readURL: function (input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
			}
			reader.readAsDataURL(input.files[0]);
		}
	},
	
	submitForm: function(form) {
		$('body').on('click', submit, function(e) {
			e.preventDefault();
			
			var formData = new FormData(form[0]);
			$.ajax({
				url: form.attr('action'),
				method: form.attr('method'),
				data: formData,
				dataType: 'JSON',
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					
				},
				error: function(response) {
					
				}
			})
		});
	}
}