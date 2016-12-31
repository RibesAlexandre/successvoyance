@extends('layouts.app')

@section('title', 'Mettre à jour mes informations')

@section('content')

    <section class="full-content">
        <h2 class="text-center">Mettre à jour mes informations</h2>
        <hr>
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                {!! BootForm::openHorizontal(['sm' => [3,9], 'lg' => [2,10]])->action( route('account.update') )->id('infos-form')->post() !!}
                {!! BootForm::bind(Auth::user()) !!}
                {!! BootForm::text('Nom', 'name', null) !!}
                {!! BootForm::text('Prénom', 'firstname', null) !!}
                {!! BootForm::email('Adresse email', 'email', null) !!}
                {!! BootForm::date('Date de naissance', 'dob', null) !!}
                {!! BootForm::submit('Mettre à jour mes informations', 'btn btn-success btn-block')->id('submit-infos') !!}
                {!! BootForm::close() !!}
            </div>
        </div>
    </section>

@endsection

@section('js')
    @parent
    <script>
        app.submitForm('#infos-form', '#submit-infos');
    </script>
@endsection