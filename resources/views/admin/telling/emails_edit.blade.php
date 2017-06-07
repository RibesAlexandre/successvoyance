@extends('layouts.admin')

@section('title', 'Mettre à jour l\'offre de Voyance par Email "' . $email->name . '"')
@section('link', route('admin.emails.edit', ['id' => $email->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.emails.index') }}">Emails de Voyance</a>
    </li>
@endsection

@section('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Mettre à jour l'offre {{ $email->name }}</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.emails.update', ['id' => $email->id]) )->id('emails-form')->put() !!}
                        {!! BootForm::bind($email) !!}
                        @include('admin.telling.emails_form')
                        {!! BootForm::submit('Mettre à jour l\'offre', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection