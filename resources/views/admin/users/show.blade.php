@extends('layouts.admin')

@section('title', $user->full_name)
@section('link', route('admin.users.show', ['id' => $user->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.users.index') }}">Utilisateurs</a>
    </li>
    <li>
        <a href="{{ route('admin.users.show', ['id' => $user->id]) }}">{{ $user->full_name }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">{{ $user->full_name }}</h4>
                    </div>
                    <div class="content">
                        {!! BootForm::open()->action( route('admin.users.update', ['id' => $user->id]) )->id('user-form')->put() !!}
                        {!! BootForm::bind($user) !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! BootForm::text('Pseudo', 'nickname') !!}
                            </div>
                            <div class="col-md-6">
                                {!! BootForm::email('Adresse email', 'email') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! BootForm::text('Nom', 'name') !!}
                            </div>
                            <div class="col-md-6">
                                {!! BootForm::text('Prénom', 'firstname') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! BootForm::password('Mot de passe', 'password')->helpBlock('Laissez vide pour ne pas changer le mot de passe de l\'utilisateur.') !!}
                            </div>
                            <div class="col-md-6">
                                {!! BootForm::password('Confirmation du mot de passe', 'password_confirm') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {!! BootForm::select('Voyant associé', 'soothsayer_id', $soothsayers) !!}
                            </div>
                        </div>
                        {!! BootForm::submit('Modifier le profil de l\'utilisateur', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="{{ $user->avatar() }}" alt="{{ $user->full_name }}"/>

                                <h4 class="title">{{ $user->full_name }}<br />
                                    <small>{{ $user->email }}</small>
                                </h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
		app.submitForm('#user-form', '#btn-submit');
    </script>
@endsection