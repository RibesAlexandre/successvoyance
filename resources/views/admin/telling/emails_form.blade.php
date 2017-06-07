{!! BootForm::text('Nom de l\'offre', 'name', null) !!}
{!! BootForm::textarea('Description de l\'offre', 'content', null)->id('summernote') !!}
{!! BootForm::text('Montant de l\'offre (centimes)', 'amount', null)->type('number') !!}
{!! BootForm::text('Quantité d\'emails', 'quantity', null)->type('number') !!}
{!! BootForm::checkbox('Offre populaire ?', 'popular', null)->value(true) !!}
{!! BootForm::checkbox('Offre active ?', 'enabled', null)->value(true) !!}

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
			});

			app.submitForm('#emails-form', '#btn-submit');
		});
    </script>
@endsection