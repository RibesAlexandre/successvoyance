@extends('layouts.app')

@section('title', 'Mes paramètres')

@push('breadcrumbs')
<li><a href="{{ route('account') }}">Mon compte</a></li>
<li>Mes paramètres</li>
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="col-lg-3 col-md-3 col-sm-4">
                @include('auth.account.partials.menu')
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8">
                <ul class="nav nav-tabs nav-top-border">
                    <li class="active"><a href="#info" data-toggle="tab">Informations</a></li>
                    <li><a href="#avatar" data-toggle="tab">Avatar</a></li>
                    <li><a href="#password" data-toggle="tab">Mot de passe</a></li>
                    <li><a href="#privacy" data-toggle="tab">Paramètres</a></li>
                </ul>

                <div class="tab-content margin-top-20">

                    <div class="tab-pane fade in active" id="info">
                        {!! BootForm::openHorizontal(['sm' => [3,9], 'lg' => [2,10]])->action( route('account.update') )->id('form-infos')->post() !!}
                        {!! BootForm::bind($user) !!}
                        {!! BootForm::text('Pseudo', 'nickname', null)->disable() !!}
                        {!! BootForm::email('Adresse email', 'email', null)->required() !!}
                        {!! BootForm::text('Nom', 'name', null) !!}
                        {!! BootForm::text('Prénom', 'firstname', null) !!}
                        {!! BootForm::date('Date de naissance', 'dob', null) !!}
                        {!! BootForm::text('Pays', 'country', null) !!}
                        {!! BootForm::text('Ville', 'city', null) !!}
                        {!! BootForm::text('Votre profession', 'job', null) !!}
                        {!! BootForm::text('Votre site web', 'website', null) !!}
                        {!! BootForm::textarea('Votre mini biographie', 'biography', null) !!}
                        {!! BootForm::submit('Mettre à jour mes informations', 'btn btn-success btn-block')->id('submit-infos') !!}
                        {!! BootForm::close() !!}
                    </div>

                    <div class="tab-pane" id="avatar">
                        {!! BootForm::open()->action(route('account.avatar.update'))->id('form-avatar')->files('true') !!}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <div class="thumbnail" id="picture">
                                        <img class="img-responsive" src="{{ $user->avatar() }}" alt="Votre image de profil" />
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-8">
                                    <div class="sky-form nomargin">
                                        <label class="label">Choisir un fichier</label>
                                        <label for="file" class="input input-file">
                                            <div class="button">
                                                <input type="file" id="picture" name="picture" onchange="this.parentNode.nextSibling.value = this.value">Parcourir
                                            </div><input type="text" readonly>
                                        </label>
                                    </div>
                                    <a href="{{ route('account.avatar.delete') }}" class="btn btn-danger btn-xs noradius" data-action="json"><i class="fa fa-times"></i> Supprimer mon image de profil</a>

                                    <div class="clearfix margin-top-20">
                                        <span class="label label-warning">Informations</span>
                                        <p>
                                            Votre avatar ne doit pas dépasser <strong>250 ko</strong> et ne doit pas dépasser la dimension <strong>700 pixels par 460 pixels</strong>
                                        </p>
                                    </div>
                                    {!! BootForm::submit('Mettre à jour mon image de profil', 'btn btn-success')->id('submit-avatar') !!}
                                </div>
                            </div>
                        </div>
                        {!! BootForm::close() !!}
                    </div>

                    <div class="tab-pane" id="password">
                        {!! BootForm::openHorizontal(['sm' => [3,9], 'lg' => [2,10]])->action( route('account.password.update') )->id('form-password')->post() !!}
                        {!! BootForm::bind(Auth::user()) !!}
                        {!! BootForm::password('Ancien mot de passe', 'old_password', null)->id('old_password') !!}
                        {!! BootForm::password('Nouveau mot de passe', 'password', null)->id('password') !!}
                        {!! BootForm::password('Confirmation', 'password_confirmation', null) !!}
                        {!! BootForm::submit('Mettre à jour mon mot de passe', 'btn btn-success btn-block')->id('submit-password') !!}
                        {!! BootForm::close() !!}
                    </div>

                    <div class="tab-pane" id="privacy">
                        {!! BootForm::open()->action( route('account.privacy.update') )->id('form-privacy')->post() !!}
                        <div class="sky-form">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td>Comment souhaitez vous être visible sur le site ?</td>
                                    <td>
                                        {!! Form::select('can_full_name', [
                                            '0' =>  'Pseudonyme',
                                            '1' =>  'Prénom',
                                            '2' =>  'Prénom + Nom',
                                        ], $user->can_full_name, ['class' => 'form-control input-sm']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Souhaitez vous que les utilisateurs puissent vous contacter sur votre adresse email ?</td>
                                    <td>
                                        <label class="checkbox nomargin">
                                            {!! Form::checkbox('can_contact', 1, $user->can_contact) !!}<i></i> Oui
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Souhaitez vous afficher votre âge ? <small>Si vous avez renseigné votre date de naissance.</small></td>
                                    <td>
                                        <label class="checkbox nomargin">
                                            {!! Form::checkbox('can_age', 1, $user->can_age) !!}<i></i> Oui
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Souhaitez vous être abonné à la newsletter ? ?</td>
                                    <td>
                                        <label class="checkbox nomargin">
                                            {!! Form::checkbox('can_newsletter', 1, $user->can_newsletter) !!}<i></i> Oui
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Souhaitez vous être abonné à l'horoscope ? <small>Si vous avez renseigné votre date de naissance.</small></td>
                                    <td>
                                        <label class="checkbox nomargin">
                                            {!! Form::checkbox('can_astrological', 1, $user->can_astrological) !!}<i></i> Oui
                                        </label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        {!! BootForm::submit('Mettre à jour mes préférences', 'btn btn-success btn-block')->id('submit-privacy') !!}
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        app.submitForm('#form-infos', '#submit-infos');
        app.submitForm('#form-avatar', '#submit-avatar');
        app.submitForm('#form-password', '#submit-password');
        app.submitForm('#form-privacy', '#submit-privacy');
    </script>
@endsection