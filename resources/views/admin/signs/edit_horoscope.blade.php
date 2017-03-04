@extends('layouts.admin')

@section('title', 'Mettre à jour l\'horoscope')
@section('link', route('admin.signs.edit_horoscope', ['id' => $horoscope->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.signs.index') }}">Signes astrologiques</a>
    </li>
@endsection

@section('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Créer un nouvel horoscope</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.signs.update_horoscope', ['id' => $horoscope->id]) )->id('horoscope-form')->patch() !!}
                        {!! BootForm::bind($horoscope) !!}
                        @include('admin.signs.form_horoscope', ['title' => 'Mettre à jour l\'horoscope'])
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="pictures_list">
                @each('admin.components.picture_card', $horoscope->pictures, 'picture')
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.fr.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="{{ elixir('js/plugins.js') }}"></script>
    <script src="{{ elixir('js/laroute.js') }}"></script>
    <script>
		app.loadSummerNote('#horoscope-form', '#summernote');
		app.removePicture('#summernote');
		app.submitForm('#horoscope-form', '#btn-submit');


			$('#begin_at').datepicker({
				format: 'dd-mm-yyyy',
                locale: 'fr',
            });
			$('#ending_at').datepicker({
				format: 'dd-mm-yyyy',
                locale: 'fr',
            });
			$('#test').datepicker();

    </script>
@endsection