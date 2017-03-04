@extends('layouts.app')

@section('title', 'Réinitialiser mon mot de passe')

@push('breadcrumbs')
<li><a href="{{ url('password/email') }}">Mot de passe perdu</a></li>
@endpush

@section('content')
<section class="height-300" id="slider" style="background:url({{ $cfg['cover_password'] }})">
    <div class="overlay dark-6"><!-- dark overlay [0 to 9 opacity] --></div>

    <div class="display-table">
        <div class="display-table-cell vertical-align-middle">

            <div class="container text-center">

                <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                    Réinitialiser mon mot de passe
                </h1>

            </div>

        </div>
    </div>

</section>
<section>
    <div class="container">
        <div class="row">

            <div class="col-md-5 col-md-offset-1">
                <p class="text-justify text-muted">Un lien pour générer un nouveau mot de passe vous sera envoyé à l'adresse email saisie ci-dessous, et vous aurez 15 minutes pour générer un nouveau mot de passe.</p>
            </div>
            <div class="col-md-4">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-vertical" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Votre adresse email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Regénérer mon mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
