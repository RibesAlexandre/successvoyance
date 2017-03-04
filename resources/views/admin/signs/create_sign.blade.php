@extends('layouts.admin')

@section('title', 'Créer un nouveau signe astrologique')
@section('link', route('admin.signs.create_sign'))
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
                        <h4 class="title">Créer un nouveau signe astrologique</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.signs.store_sign') )->id('sign-form')->post() !!}
                        {!! BootForm::bind($sign) !!}
                        @include('admin.signs.form_sign', ['title' => 'Créer le signe astrologique'])
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
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ elixir('js/laroute.js') }}"></script>
    <script>
        app.loadSummerNote('#sign-form', '#summernote');
        app.removePicture('#summernote');
        app.submitForm('#sign-form', '#btn-submit');
    </script>
@endsection