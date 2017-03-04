@extends('layouts.app')

@section('title', 'Générer un nouveau mot de passe')

@push('breadcrumbs')
<li><a href="{{ url('password/email') }}">Générer un nouveau mot de passe</a></li>
@endpush

@section('content')
<section class="height-300" id="slider" style="background:url({{ $cfg['cover_password'] }})">
    <div class="overlay dark-6"><!-- dark overlay [0 to 9 opacity] --></div>

    <div class="display-table">
        <div class="display-table-cell vertical-align-middle">

            <div class="container text-center">

                <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                    Regénérer mon mot de passe
                </h1>

            </div>

        </div>
    </div>

</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-vertical" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Votre adresse email...">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Votre nouveau mot de passe...">

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmez votre nouveau mot de passe...">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Soumettre le nouveau mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
