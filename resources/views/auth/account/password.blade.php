@extends('layouts.app')

@section('title', 'Mettre à jour mon mot de passe')

@section('content')

    <section class="full-content">
        <h2 class="text-center">Mettre à jour mon mot de passe</h2>
        <hr>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                {!! BootForm::openHorizontal(['sm' => [3,9], 'lg' => [2,10]])->action( route('account.password.update') )->id('password-form')->post() !!}
                {!! BootForm::bind(Auth::user()) !!}
                {!! BootForm::password('Ancien mot de passe', 'old_password', null) !!}
                {!! BootForm::password('Nouveau mot de passe', 'password', null) !!}
                {!! BootForm::password('Confirmation', 'password_confirmation', null) !!}
                {!! BootForm::submit('Mettre à jour mon mot de passe', 'btn btn-success btn-block')->id('submit-password') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </section>

@endsection

@section('js')
    @parent
    <script>
		app.submitForm('#password-form', '#submit-password');
    </script>
@endsection