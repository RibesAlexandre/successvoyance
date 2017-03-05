@extends('layouts.admin')

@section('title', 'Mettre à jour le signe astrologique "' . $sign->name . '"')
@section('link', route('admin.signs.edit_sign', ['id' => $sign->id]))
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
                        <h4 class="title">Mettre à jour le signe astrologique "{{ $sign->name }}"</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.signs.update_sign', ['id' => $sign->id]) )->id('sign-form')->put() !!}
                        {!! BootForm::bind($sign) !!}
                        @include('admin.signs.form_sign', ['title' => 'Mettre à jour le signe astrologique'])
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="pictures_list">
                @each('admin.components.picture_card', $sign->pictures, 'picture')
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/laroute.js') }}"></script>
    <script>
		app.loadSummerNote('#sign-form', '#summernote');
		app.removePicture('#summernote');
		app.submitForm('#sign-form', '#btn-submit');
    </script>
@endsection