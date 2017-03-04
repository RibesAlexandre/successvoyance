@extends('layouts.admin')

@section('title', 'Créer une nouvelle page')
@section('link', route('admin.pages.create'))
@section('navbar')
    <li>
        <a href="{{ route('admin.pages.index') }}">Pages</a>
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
                        <h4 class="title">Créer une nouvelle page</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.pages.store') )->id('page-form')->post() !!}
                        {!! BootForm::bind($page) !!}
                        @include('admin.pages.form')
                        {!! BootForm::submit('Créer une nouvelle page', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="pictures_list">

            </div>
        </div>

    </div>
@endsection