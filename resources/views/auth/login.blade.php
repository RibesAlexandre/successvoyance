@extends('layouts.app')

@section('title', 'Me connecter')
@section('pageTitle', 'Me connecter')

@push('breadcrumbs')
<li class="active"><a href="{{ url('login') }}">Connexion</a></li>
@endpush

@section('content')
    <section class="height-300" id="slider" style="background:url({{ $cfg['cover_login'] }})">
        <div class="overlay dark-6"><!-- dark overlay [0 to 9 opacity] --></div>

        <div class="display-table">
            <div class="display-table-cell vertical-align-middle">

                <div class="container text-center">

                    <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                        Connexion
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

                    <h2 class="size-16">Se connecter</h2>
                    <form role="form" class="form-vertical" method="POST" action="{{ url('/login') }}">
                        <div class="clearfix">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Adresse email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Mot de passe">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"><i></i> Se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-sm-6 col-xs-6">

                                <!-- Inform Tip -->
                                <div class="form-tip pt-20">
                                    <a class="no-text-decoration size-13 margin-top-10 block" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">

                                <button class="btn btn-primary">Se connecter</button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
