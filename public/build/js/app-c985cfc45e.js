var app = {
	
	init: function() {
		$.ajaxSetup({
			cache: false,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
		});
		this.delete();
	},
	
	readURL: function (input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
			}
			reader.readAsDataURL(input.files[0]);
		}
	},
	
	/**
	 * Soumission d'un formulaire en AJAX
	 * @param form
	 * @param submit
	 */
	submitForm: function(form, submit) {
		$('body').on('click', submit, function(e) {
			e.preventDefault();
			
			var f = $(form);
			var formData = new FormData(f[0]);
			
			if( $('.' + f.attr('id') + '-errors').length > 0 ) {
				$('.' + f.attr('id') + '-errors').fadeOut().remove();
				$('#' + f.attr('id') + ' .form-group').removeClass('has-error');
				$('#' + f.attr('id') + ' .return-error').remove();
			}
			
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
					
					if( typeof response.alert != 'undefined' ) {
						toastr[response.type](response.message);
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
				},
				error :function(response) {
					var $errors = $.parseJSON(response.responseText);
					
					var $errorsReturn = '';
					
					$.each( $errors, function( key, value ) {
						$errorsReturn += '<li>' + value[0] + '</li>';
						$('#' + key).closest('.form-group').addClass('has-error');
						$('#' + key).after('<span class="help-block return-error">' + value[0] + '</span>');
					});
					
					f.prepend('<div class="alert alert-danger ' + f.attr('id') + '-errors"><ul>' + $errorsReturn + '</ul></di>');
				}
			})
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
			})
		})
	},
	
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
									toastr['error']('Une erreur est survenue durant la suppression de l\'élément');
								}
							}
						})
					}
				});
		})
	}
}

app.init();
//# sourceMappingURL=app.js.map
