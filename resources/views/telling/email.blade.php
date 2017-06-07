@extends('layouts.app')

@section('title', 'Voyance par email')
@section('pageTitle', 'Contactez nos voyants par email')

@push('breadcrumbs')
<li class="active">Voyance par email</li>
@endpush

@section('content')

    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">
            <div class="text-center">
                <h3 class="size-30">Choisissez votre offre</h3>
                <p>Choisisez l'offre qui vous correspond le mieux pour communiquer avec nos voyant(e)s !</p>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
            @foreach( $emails as $email )
                <div class="col-md-4 col-sm-4 margin-top-20">
                    <div class="price-clean{{ $email->popular ? ' price-clean-popular' : '' }}">
                        @if( $email->popular )
                            <div class="ribbon">
                                <div class="ribbon-inner">POPULAIRE</div>
                            </div>
                        @endif
                        <h4>
                            <sup>€</sup>{{ $email->amount_price }}
                        </h4>
                        <h5> {{ $email->name }} </h5>
                        <hr />
                        {!! $email->content !!}
                        <hr />
                        <a href="#show-offer-{{ $email->id }}" data-action="choose" data-id="{{ $email->id }}" class="btn btn-3d btn-{{ $email->popular ? 'primary' : 'teal' }}">Sélectionner</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    @if( Auth::check() )
    <section class="callout-dark heading-title heading-arrow-bottom" id="finalize">
        <div class="container">
            <div class="text-center">
                <h3 class="size-30">Finalisez votre paiement</h3>
                <p>Il ne vous reste plus qu'à procéder au paiement pour entrer en contact avec notre équipe !</p>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Informations bancaires</h3>
                        <div class="display-td text-right">
                            <ul class="list-inline">
                                <li><i class="fa fa-cc-mastercard text-warning fa-2x"></i></li>
                                <li><i class="fa fa-cc-visa text-blue fa-2x"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action="{{ route('payment.process') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="payment_type" value="email">
                        <input type="hidden" name="email_id" value="{{ Request::has('email') ? Request::get('email') : null }}">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">Numéro de carte</label>
                                    <div class="input-group">
                                        <input
                                                type="tel"
                                                class="form-control"
                                                name="cardNumber"
                                                placeholder="Votre numéro de carte bancaire"
                                                autocomplete="cc-number"
                                                required autofocus
                                        />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">Date d'expiration</span><span class="visible-xs-inline">EXP</span></label>
                                    <input
                                            type="tel"
                                            class="form-control"
                                            name="cardExpiry"
                                            placeholder="MM / AA"
                                            autocomplete="cc-exp"
                                            required
                                    />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">Code de Sécurité</label>
                                    <input
                                            type="tel"
                                            class="form-control"
                                            name="cardCVC"
                                            placeholder="CVC"
                                            autocomplete="cc-csc"
                                            required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="submit" class="subscribe btn btn-success btn-lg btn-block" type="button">Soumettre</button>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @else
    <section class="callout-dark heading-title heading-arrow-bottom" id="finalize">
        <div class="container">
            <div class="text-center">
                <h3 class="size-30">Connectez vous / Inscrivez vous !</h3>
                <p>Pour pouvoir contacter nos voyant(e)s par email, vous devez posséder un compte. Utilisez le formulaire approprié selon si vous possédez un compte chez {{ config('app.name') }} ou non.</p>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box-static box-border-top padding-30">
                        <div class="box-title margin-bottom-30">
                            <h2 class="size-20">J'ai déjà un compte</h2>
                        </div>

                        <form class="sky-form" method="post" action="{{ route('telling.signin') }}" autocomplete="off" id="form-login">
                            <input type="hidden" name="email_id_login" value="">
                            <div class="clearfix">

                                <!-- Email -->
                                <div class="form-group">
                                    <label>Adresse email</label>
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-envelope"></i>
                                        <input name="email_login" id="email_login" required type="email">
                                        <b class="tooltip tooltip-bottom-right">Votre adresse email</b>
                                    </label>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <label class="input margin-bottom-10">
                                        <i class="ico-append fa fa-lock"></i>
                                        <input name="password_login" id="password_login" required type="password">
                                        <b class="tooltip tooltip-bottom-right">Votre mot de passe</b>
                                    </label>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-tip pt-20">
                                        <a class="no-text-decoration size-13 margin-top-10 block" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                    <button class="btn btn-primary" type="submit" id="submit-login"><i class="fa fa-check"></i> Me connecter</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="box-static box-transparent box-bordered padding-30">

                        <div class="box-title margin-bottom-30">
                            <h2 class="size-20">Je n'ai pas de compte</h2>
                        </div>

                        <form class="nomargin sky-form" action="{{ route('telling.signup') }}" method="post" enctype="multipart/form-data" id="form-register">
                            <input type="hidden" name="email_id_register" value="">
                            <fieldset>

                                <div class="row">
                                    <div class="form-group">

                                        <div class="col-md-6 col-sm-6">
                                            <label>Prénom *</label>
                                            <label class="input margin-bottom-10">
                                                <i class="ico-append fa fa-user"></i>
                                                <input required name="firstname_register" id="firstname_register" type="text">
                                                <b class="tooltip tooltip-bottom-right">Votre prénom</b>
                                            </label>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <label for="register:last_name">Nom *</label>
                                            <label class="input margin-bottom-10">
                                                <i class="ico-append fa fa-user"></i>
                                                <input required name="name_register" id="name_register" type="text">
                                                <b class="tooltip tooltip-bottom-right">Votre nom</b>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">

                                        <div class="col-md-6 col-sm-6">
                                            <label for="register:email">Adresse email *</label>
                                            <label class="input margin-bottom-10">
                                                <i class="ico-append fa fa-envelope"></i>
                                                <input required name="email_register" id="email_register" type="email">
                                                <b class="tooltip tooltip-bottom-right">Votre adresse email pour vous connecter</b>
                                            </label>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <label for="register:phone">Pseudonyme *</label>
                                            <label class="input margin-bottom-10">
                                                <i class="ico-append fa fa-user-secret"></i>
                                                <input type="text" name="nickname_register" id="nickname_register" required>
                                                <b class="tooltip tooltip-bottom-right">Votre pseudonyme sur le site</b>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">

                                        <div class="col-md-6 col-sm-6">
                                            <label for="register:pass1">Mot de passe *</label>
                                            <label class="input margin-bottom-10">
                                                <i class="ico-append fa fa-lock"></i>
                                                <input required="" type="password" name="password_register" id="password_register">
                                                <b class="tooltip tooltip-bottom-right">Votre mot de passe, 6 caractères minimum</b>
                                            </label>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <label for="register:pass2">Confirmation du mot de passe *</label>
                                            <label class="input margin-bottom-10">
                                                <i class="ico-append fa fa-lock"></i>
                                                <input required="" type="password" name="password_register_confirmation" id="password_register_confirmation">
                                                <b class="tooltip tooltip-bottom-right">Confirmation de votre mot de passe</b>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                {{--
                                <hr />

                                <label class="checkbox nomargin"><input class="checked-agree" type="checkbox" name="checkbox"><i></i>I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a></label>
                                <label class="checkbox nomargin"><input type="checkbox" name="checkbox"><i></i>I want to receive news and  special offers</label>
                                --}}
                            </fieldset>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" id="submit-register" class="btn btn-primary"><i class="fa fa-check"></i> M'inscrire</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
    @endif

@endsection

@section('css')
    <link rel="stylesheet" href="{{ elixir('css/payment.css') }}">
@endsection

@section('js')
    @parent
    <script>
        $('body').on('click', '[data-action="choose"]', function(e) {
        	e.preventDefault();
        	$('input[name="email_id"]').attr('value', $(this).attr('data-id'));
        	@if( Auth::guest() )
        	$('input[name="email_id_login"]').attr('value', $(this).attr('data-id'));
        	$('input[name="email_id_register"]').attr('value', $(this).attr('data-id'));
        	@endif
			$('html,body').animate({
                scrollTop: $('#finalize').offset().top},
            'slow');
        });

        app.submitForm('#form-login', '#submit-login');
        app.submitForm('#form-register', '#submit-register');
    </script>
@endsection