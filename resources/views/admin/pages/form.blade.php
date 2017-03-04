{!! BootForm::text('Nom de la page', 'name', null) !!}
{!! BootForm::textarea('Contenu de la page', 'content', null)->id('summernote') !!}

@section('js')
    @parent
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ elixir('js/laroute.js') }}"></script>
    <script>
		$(document).ready(function() {
			$('#summernote').summernote({
				height: 500,
				lang: 'fr-FR',
				dialogsInBody: true,
				callbacks: {
					onImageUpload: function(image) {
						uploadImage(image[0]);
					},
				}
			});

			function uploadImage(image) {
				var data = new FormData();
				data.append('picture', image);
				//data.append('_token', $('meta[name="csrf-token"]').attr('content'));
				data.append('_method', 'POST');
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
						$('#summernote').summernote('insertImage', response.url, function($image) {
							$image.attr('class', 'img-responsive');
							$image.attr('id', response.name);
						});

						$('#pictures_list').append(response.content);
						$('#page-form').prepend('<input name=pictures[] type="hidden" id="picture_' + response.id + '" value="' + response.id + '">');
					}, error: function(response) {
						var $errors = $.parseJSON(response.responseText);
						$.each( $errors, function( key, value ) {
							toastr.error(value[0]);
						});
                    }
				});
			}

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
							$('#summernote').summernote('removeMedia', $('#' + response.name));
						}
					}
				})
            })

			app.submitForm('#page-form', '#btn-submit');
		});
    </script>
@endsection