@extends('layouts.admin')

@section('title', 'Modifier un rôle')
@section('link', route('admin.roles.edit', ['id' => $role->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.roles.index') }}">Rôles</a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="header">
                <h4 class="title text-center">Mettre à jour le rôle "{{ $role->name }}"</h4>
            </div>
            <div class="content">
                {!! BootForm::open()->action(route('admin.roles.update', ['id' => $role->id]))->id('role-form')->post() !!}
                {!! BootForm::bind($role) !!}
                @include('admin.roles.form')
                {!! BootForm::submit('Mettre à jour le rôle', 'btn btn-success btn-block btn-fill') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection