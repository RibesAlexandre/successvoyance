@extends('layouts.app')

@section('title', 'M\'enregistrer')

@push('breadcrumbs')
<li><a href="{{ url('register') }}">Inscription</a></li>
@endpush

@section('content')
<section class="height-300" id="slider" style="background:url({{ $cfg['cover_login'] }})">
    <div class="overlay dark-6"><!-- dark overlay [0 to 9 opacity] --></div>

    <div class="display-table">
        <div class="display-table-cell vertical-align-middle">

            <div class="container text-center">

                <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                    Inscription
                </h1>

            </div>

        </div>
    </div>

</section>
<section>
    <div class="container">

        <div class="row">

            <div class="col-md-5 col-md-offset-1">

                <h2 class="size-16">Informations</h2>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur deleniti nam repellat sed, temporibus ullam voluptas voluptatum. Amet cum error in, itaque laborum magni minima, necessitatibus quas quidem temporibus totam?</p>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto atque blanditiis consequuntur dolores exercitationem mollitia quidem repellat sapiente tempora. Ab doloremque ea esse est modi odio quisquam ullam vel.</p>

            </div>
            <div class="col-md-4">

                <h2 class="size-16">S'inscrire</h2>
                <form class="form-vertical" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Votre adresse email...">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                        <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" required placeholder="Votre pseudonyme...">

                        @if ($errors->has('nickname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nickname') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus placeholder="Votre nom...">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="votre prénom...">

                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Votre mot de passe...">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmez votre mot de passe...">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
