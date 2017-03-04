@extends('layouts.admin')

@section('title', 'Mettre à jour une page')
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
                        <h4 class="title">Mettre à jour la page "{{ $page->name }}"</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.pages.update', ['id' => $page->id]) )->id('page-form')->patch() !!}
                        {!! BootForm::bind($page) !!}
                        @include('admin.pages.form')
                        {!! BootForm::submit('Mettre la page à jour', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3" id="pictures_list">
            @each('admin.components.picture_card', $page->pictures, 'picture')
            </div>
        </div>

    </div>
@endsection