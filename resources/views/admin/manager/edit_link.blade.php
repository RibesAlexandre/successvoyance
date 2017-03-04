@extends('layouts.admin')

@section('title', 'Modifier un lien')
@section('link', route('admin.manager.edit_link', ['id' => $link->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.manager.index') }}">Management</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Mettre à jour le lien {{ $link->name }}</h4>
            </div>
            <div class="content">
                {!! BootForm::open()->action( route('admin.manager.update_link', ['id' => $link->id]) )->id('link-form')->patch() !!}
                {!! BootForm::bind($link) !!}
                @include('admin.manager.form_link', ['title' => 'Mettre à jour le lien'])
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
		app.submitForm('#link-form', '#btn-submit');
    </script>
@endsection