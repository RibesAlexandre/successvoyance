@extends('layouts.admin')

@section('title', 'Créer un nouveau carousel')
@section('link', route('admin.manager.create_carousel'))
@section('navbar')
    <li>
        <a href="{{ route('admin.manager.index') }}">Management</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Créer une nouveau carousel</h4>
            </div>
            <div class="content">
                {!! BootForm::open()->action( route('admin.manager.store_carousel') )->id('carousel-form')->files(true)->post() !!}
                {!! BootForm::bind($carousel) !!}
                @include('admin.manager.form_carousel', ['title' => 'Créer un nouveau carousel'])
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
		app.submitForm('#carousel-form', '#btn-submit');
    </script>
@endsection