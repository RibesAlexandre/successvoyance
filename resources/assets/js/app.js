window.width = $(window).width();
var plugin_path = 'js/plugins';

var app = {
	
	/**
	 * On initialise l'application
	 */
	init: function() {
		$.ajaxSetup({
			cache: false,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
		});
		
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		
		this.delete();
		this.loadJson();
		this.loadDataOnClick();
		components.init();
		actions.init();
	},
	
	/**
	 * Soumission d'un formulaire en AJAX
	 * @param form
	 * @param submit
	 */
	submitForm: function(form, submit, callback) {
		$('body').on('click', submit, function(e) {
			e.preventDefault();
			
			var f = $(form);
			var formData = new FormData(f[0]);
			
			if( $('.' + f.attr('id') + '-errors').length > 0 ) {
				$('.' + f.attr('id') + '-errors').fadeOut().remove();
				$('#' + f.attr('id') + ' .form-group').removeClass('has-error');
				$('#' + f.attr('id') + ' .return-error').remove();
			}
			
			var btnText = $(submit).html();
			$(submit).html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
			
			$.ajax({
				url: f.attr('action'),
				method: f.attr('method'),
				data: formData,
				dataType: 'JSON',
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					
					console.log(response);
					
					var timer = 0;
					if( typeof response.timer != 'undefined' ) {
						timer = response.timer;
						if( typeof response.redirect != 'undefined' && timer == 0 ) {
							timer = 5000;
						}
					}
					
					console.log(timer);
					
					setTimeout(function() {
						if( typeof response.alert != 'undefined' ) {
							var alertType = '';
							if( typeof response.type != 'undefined' ) {
								alertType = response.type;
							} else {
								if( response.success ) {
									alertType = 'success';
								} else {
									alertType = 'error';
								}
							}
							toastr[alertType](response.message);
						} else if( typeof response.content != 'undefined' ) {
							$(response.element)[response.method](response.content);
						}
						
						if( typeof response.clean != 'undefined' && typeof response.to_clean != 'undefined' && response.clean ) {
							$.each(response.to_clean, function(key, value) {
								if( $('#' + value).length > 0 ) {
									$('#' + value).val('');
								}
							});
						}
						
						if( typeof response.inputs != 'undefined' ) {
							$.each(response.inputs, function(key, value) {
								if( $('#' + key).length > 0 ) {
									$('#' + key).val(value);
								}
							});
						}
						
						if( typeof response.redirect != 'undefined' ) {
							//var timer = typeof response.timer == 'undefined' ? 5000 : response.timer;
							//setTimeout(function() {
								$(location).attr('href', response.redirect);
							//}, timer);
						}
					}, timer);
					$(submit).html(btnText);
					
					if( typeof callback != 'undefined' && typeof callback == 'function' ) {
						callback();
					}
				},
				error :function(response) {
					var $errorsReturn = '';
					var $errors = $.parseJSON(response.responseText);
					
					$.each( $errors, function( key, value ) {
						$errorsReturn += '<li>' + value[0] + '</li>';
						$('#' + f.attr('id') + ' #' + key).parents('.form-group').addClass('has-error');
						$('#' + f.attr('id') + ' #' + key).after('<span class="help-block return-error">' + value[0] + '</span>');
					});
					
					f.prepend('<div class="alert alert-danger ' + f.attr('id') + '-errors"><ul>' + $errorsReturn + '</ul></di>');
					$(submit).html(btnText);
				}
			});
		});
	},
	
	/**
	 * Permet d'intéragir en JSON facilement
	 */
	loadJson: function() {
		$('body').on('click', '[data-action="json"]', function(e) {
			e.preventDefault();
			$.ajax({
				url: $(this).attr('href'),
				method: 'GET',
				dataType: 'JSON',
				success: function(response) {
					if( response.success ) {
						
						var timer = 0;
						if( typeof response.timer != 'undefined' ) {
							timer = response.timer;
							if( typeof response.redirect != 'undefined' && timer == 0 ) {
								timer = 5000;
							}
						}
						
						console.log(timer);
						
						setTimeout(function() {
							if( typeof response.alert != 'undefined' ) {
								var alertType = 'success';
								if( typeof response.type != 'undefined' ) {
									alertType = response.type;
								}
								toastr[alertType](response.message);
							} else if( typeof response.content != 'undefined' ) {
								$(response.element)[response.method](response.content);
							}
							
							if( typeof response.redirect != 'undefined' ) {
								//var timer = typeof response.timer == 'undefined' ? 5000 : response.timer;
								//setTimeout(function() {
									$(location).attr('href', response.redirect);
								//}, timer);
							}
						}, timer);
					} else {
						toastr['error'](response.message);
					}
				},
			})
		})
	},
	
	
	/**
	 * Permet de charger avec des réglages prédéfinis summernote
	 * @param form
	 * @param textarea
	 */
	loadSummerNote: function(form, textarea) {
		$(textarea).summernote({
			height: 500,
			lang: 'fr-FR',
			dialogsInBody: true,
			callbacks: {
				onImageUpload: function(image) {
					console.log(image[0]);
					uploadImage(image[0]);
				},
			}
		});
		
		/**
		 * Upload d'image en AJAX avec summernote
		 * @param image
		 */
		function uploadImage(image) {
			var data = new FormData();
			data.append('picture', image);
			//data.append('_token', $('meta[name="csrf-token"]').attr('content'));
			data.append('_method', 'POST');
			data.append('_token', $('meta[name="csrf-token"]').attr('content'));
			console.log(data);
			//console.log(data);
			$.ajax({
				//data: {picture: file, _token: $('meta[name="csrf-token"]').attr('content'), _method: 'POST'},
				data: data,
				method: 'POST',
				url: laroute.route('admin.pictures.upload'),
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					console.log(response);
					$(textarea).summernote('insertImage', response.url, function($image) {
						$image.attr('class', 'img-responsive');
						$image.attr('id', response.name);
					});
					
					$('#pictures_list').append(response.content);
					$(form).prepend('<input name=pictures[] type="hidden" id="picture_' + response.id + '" value="' + response.id + '">');
				}, error: function(response) {
					console.log(response);
					var $errors = $.parseJSON(response.responseText);
					$.each( $errors, function( key, value ) {
						toastr.error(value[0]);
					});
				}
			});
		}
	},
	
	/**
	 * Permet de supprimer une photo dans l'éditeur, en la retirant également sur summernote
	 * @param summernote
	 */
	removePicture: function(summernote) {
		$('body').on('click', '[data-action="remove-picture"]', function(e) {
			e.preventDefault();
			$.ajax({
				method: 'GET',
				url: laroute.route('admin.pictures.destroy'),
				data: {image: $(this).attr('data-name')},
				success: function(response) {
					if( response.success ) {
						$('#picture_' + response.id).remove();
						$('#picture_card_' + response.id).remove();
						$(summernote).summernote('removeMedia', $('#' + response.name));
					}
				}
			});
		});
	},
	
	/**
	 * Récupération de données en AJAX
	 */
	loadDataOnClick: function() {
		$('body').on('click', '[data-action=load]', function(e) {
			e.preventDefault();
			$.get($(this).attr('href'), function(response) {
				if( typeof response.alert != 'undefined' ) {
					toastr[response.type](response.message);
				} else {
					$(response.element)[response.method](response.content);
				}
			});
		});
	},
	
	/**
	 * Permet de charger plus d'éléments
	 */
	loadMore: function() {
		$('body').on('click', '[data-action=load-more]', function(e) {
			e.preventDefault();
			var $this = $(this);
			$.get($this.attr('href'), function(response) {
				console.log(response);
				if( response.count > 0 ) {
					$this.attr('href', response.href);
					$(response.element)[response.method](response.content);
				} else {
					$(response.element)[response.method](response.content);
					$this.addClass('disabled');
				}
			});
		});
	},
	
	/**
	 * Permet d'ordonner des liens facilement
	 */
	orderLinks: function() {
		$('body').on('click', '[data-action="order"]', function(e) {
			e.preventDefault();
			var action = $(this);
			var div = action.attr('data-div');
			$.get(action.attr('href'), function(response) {
				if( response.success ) {
					//$('#link_' + response.link.id).remove();
					//link.find('data-info=["position"]').text(response.link.position);
					if( action.attr('data-asc') == 'up' ) {
						$('#' + div + '_' + response.element.id).insertBefore('#' + div + '_' + response.move.id);
					} else {
						$('#' + div + '_' + response.element.id).insertAfter('#' + div + '_' + response.move.id);
					}
					
					$('#' + div + '_' + response.element.id).find('[data-info="position"]').text(response.position);
					$('#' + div + '_' + response.move.id).find('[data-info="position"]').text(response.move_pos);
				}
			});
		});
	},
	
	/**
	 * Box de suppression en AJAX avec confirmation
	 */
	delete: function() {
		$('body').on('click', '[data-action="delete"]', function(e) {
			e.preventDefault();
			var data = $(this);
			var dataId = $(this).attr('data-id');
			
			swal({
				title: "Êtes vous sûr ?",
				text: data.attr('data-message'),
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Oui",
				cancelButtonText: "Non",
				closeOnConfirm: true,
				closeOnCancel: true
				},
				function(isConfirm){
					if( isConfirm ) {
						$.ajax({
							url: data.attr('href'),
							method: 'POST',
							data: {_method: 'delete', _token: data.attr('data-token')},
							success: function(response) {
								console.log(response.success);
								if( typeof response.success != 'undefined' && response.success ) {
									$('#' + dataId).fadeOut().remove();
									if( typeof response.message != 'undefined' ) {
										toastr['success'](response.message);
									}
								} else {
									var message = typeof response.message == 'undefined' ? 'Une erreur est survenue durant la suppression de l\'élément' : response.message;
									toastr['error'](message);
								}
							}
						})
					}
				});
		});
	}
};

/**
 * Let's GO !
 */
app.init();