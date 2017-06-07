@extends('layouts.admin')

@section('title', 'Créer une nouvelle offre de Voyance par Email')
@section('link', route('admin.emails.create'))
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
                    <h4 class="title">Créer une nouvelle offre</h4>
                </div>
                <div class="content">
                    {!! BootForm::open()->action( route('admin.emails.store') )->id('emails-form')->post() !!}
                    {!! BootForm::bind($email) !!}
                    @include('admin.telling.emails_form')
                    {!! BootForm::submit('Créer une nouvelle page', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection