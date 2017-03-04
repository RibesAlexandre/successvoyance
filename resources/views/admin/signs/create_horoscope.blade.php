@extends('layouts.admin')

@section('title', 'Enregistrer un nouvel horoscope')
@section('link', route('admin.signs.create_horoscope'))
@section('navbar')
    <li>
        <a href="{{ route('admin.signs.index') }}">Signes astrologiques</a>
    </li>
@endsection

@section('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
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
                        {!! BootForm::open()->action( route('admin.signs.store_horoscope') )->id('horoscope-form')->post() !!}
                        {!! BootForm::bind($horoscope) !!}
                        @include('admin.signs.form_horoscope', ['title' => 'Enregistrer le nouvel horoscope'])
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="pictures_list">

            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="{{ elixir('js/plugins.js') }}"></script>
    <script src="{{ elixir('js/laroute.js') }}"></script>
    <script>
		app.loadSummerNote('#horoscope-form', '#summernote');
		app.removePicture('#summernote');
		app.submitForm('#horoscope-form', '#btn-submit');
    </script>
@endsection