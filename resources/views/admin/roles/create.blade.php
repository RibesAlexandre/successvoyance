@extends('layouts.admin')

@section('title', 'Créer un rôle')
@section('link', route('admin.roles.create'))
@section('navbar')
    <li>
        <a href="{{ route('admin.roles.index') }}">Rôles</a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="header">
                <h4 class="title">Créer un rôle</h4>
            </div>
            <div class="content">
                {!! BootForm::open()->action( route('admin.roles.store') )->id('role-form')->post() !!}
                {!! BootForm::bind($role) !!}
                @include('admin.roles.form')
                {!! BootForm::submit('Créer un nouveau rôle', 'btn btn-success btn-block btn-fill') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection