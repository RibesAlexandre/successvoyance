<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('metas')

    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="{{ elixir('css/components.css') }}" rel="stylesheet">
    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = <?= json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="boxed">
<div id="wrapper">
    <div id="topBar">
        <div class="container">

            <!-- right -->
            <ul class="top-links list-inline pull-right">
                @if( Auth::check() )
                <li class="text-welcome">Bienvenue <strong>{{ Auth::user()->firstname }}</strong></li>
                <li>
                    <a class="dropdown-toggle no-text-underline" data-toggle="dropdown" href="#"><i class="fa fa-user hidden-xs"></i> Mon compte</a>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="{{ route('account') }}"><i class="fa fa-user"></i>Accueil</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="{{ route('account.edit') }}"><i class="fa fa-cog"></i>  Paramètres</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="{{ route('account.emails') }}"><i class="fa fa-paper-plane"></i> Emails Voyance</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Déconnexion</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a href="{{ url('login') }}">Connexion</a></li>
                <li><a href="{{ url('register') }}">Inscription</a></li>
                @endif
            </ul>

        </div>
    </div>


    <div id="header" class="clearfix sticky">

        <div class="search-box over-header">
            <a id="closeSearch" href="#" class="fa fa-times"></a>

            <form action="{{ route('search.post') }}" method="post">
                {!! csrf_field() !!}
                <input type="text" class="form-control" placeholder="Rechercher" />
            </form>
        </div>

        <header id="topNav">
            <div class="container">

                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>

                <ul class="pull-right nav nav-pills nav-second-main">
                    <li class="search">
                        <a href="javascript:;">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>
                </ul>

                <a class="logo pull-left" href="{{ route('home') }}">
                    <img src="{{ $cfg['logo'] }}" alt="{{ $cfg['name'] }}" class="img-responsive">
                </a>

                <div class="navbar-collapse pull-right nav-main-collapse collapse">
                    <nav class="nav-main">
                        <ul id="topMain" class="nav nav-pills nav-main">
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#">Signes Astrologiques</a>
                                <ul class="dropdown-menu">
                                    @foreach( $astrologicalSignsList as $sign )
                                        <li><a href="{{ route('signs.show', ['sign' => $sign->slug]) }}"><img src="{{ $sign->logo }}" class="img-responsive width-20" alt="{{ $sign->name }}"> {{ $sign->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach( $headerLinks as $link )
                            <li>
                                <a href="{{ count($link->childrens) > 0 ? '#' : url($link->link) }}"{{ count($link->childrens) > 0 ? ' class="dropdown-toggle"' : '' }} alt="{{ $link->name }}">{{ $link->name }}</a>
                                @if( count($link->childrens) > 0 )
                                <ul class="dropdown-menu">
                                    @foreach( $link->childrens as $child )
                                    <li><a href="{{ url($child->link) }}" alt="{{ $child->name }}">{{ $child->name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
    </div>
    <section class="page-header page-header-xs bread{{ isInRoute('home') ? ' hidden' : '' }}">
        <div class="container">

            <h1>@yield('pageTitle')</h1>

            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{ route('home') }}">{{ $cfg['name'] }}</a></li>
                @stack('breadcrumbs')
            </ol>

        </div>
    </section>

    {{--
    <section class="page-header page-header-xs bread{{ isInRoute('home') ? ' hidden' : '' }}">
        <div class="container">
            <ol class="breadcrumb breadcrumb-inverse">
                <li><i class="fa fa-home"></i> <a href="{{ route('home') }}">{{ $cfg['name'] }}</a></li>
                @stack('breadcrumbs')
            </ol>
        </div>
    </section>
    --}}

    @yield('content')
</div>

<footer id="footer">
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <img class="footer-logo width-200 center-block img-rounded img-thumbnail" src="{{ $cfg['logo'] }}" alt="{{ $cfg['name'] }}" />

                <p>{{ $cfg['description'] }}</p>
            </div>

            <div class="col-md-2">
                <h4 class="letter-spacing-1">Navigation</h4>
                <ul class="footer-links list-unstyled">
                    @foreach( $footerLinks as $link )
                        <li><a href="{{ url($link->link) }}">{{ $link->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-3">

                <!-- Latest Blog Post -->
                <h4 class="letter-spacing-1">Signes Astrologiques</h4>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <ul class="footer-links list-unstyled">
                        @foreach( $astrologicalSignsList->take(6)->all() as $sign )
                            <li><a href="{{ route('signs.show', ['sign' => $sign->slug]) }}"><img src="{{ $sign->logo }}" class="img-responsive width-20" alt="{{ $sign->name }}"> {{ $sign->name }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="footer-links list-unstyled">
                            @foreach( $astrologicalSignsList->splice(6)->all() as $sign )
                                <li><a href="{{ route('signs.show', ['sign' => $sign->slug]) }}"><img src="{{ $sign->logo }}" class="img-responsive width-20" alt="{{ $sign->name }}"> {{ $sign->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <h4 class="letter-spacing-1">Restez connecté !</h4>
                <p>Inscrivez vous à notre newsletter pour profiter de nos promotions et des nouveautés du site.</p>

                <form class="validate" action="{{ route('newsletter.post') }}" method="post" data-success="Subscribed! Thank you!" data-toastr-position="bottom-right" id="newsletter-form">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" id="newsletter_email" name="newsletter_email" class="form-control required" placeholder="Votre adresse email">
                        <span class="input-group-btn">
                                <button class="btn btn-success" type="submit" id="newsletter-submit">S'inscrire !</button>
                            </span>
                    </div>
                </form>
                <div class="margin-top-20">
                    <a href="#" class="social-icon social-icon-border social-facebook pull-left" data-toggle="tooltip" data-placement="top" title="Facebook">

                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="social-icon social-icon-border social-twitter pull-left" data-toggle="tooltip" data-placement="top" title="Twitter">
                        <i class="fa fa-twitter"></i>
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" class="social-icon social-icon-border social-gplus pull-left" data-toggle="tooltip" data-placement="top" title="Google plus">
                        <i class="fa fa-google-plus"></i>
                        <i class="fa fa-google-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a href="{{ route('page', ['slug' => 'conditions-dutilisations']) }}">Conditions d'utilisations</a></li>
                <li>&bull;</li>
                <li><a href="{{ route('page', ['slug' => 'conditions-generales-de-ventes']) }}">CGV</a></li>
            </ul>
            &copy; {{ date('Y') }} Success Voyance - Tous droits réservés | Réalisé avec <i class="fa fa-heart text-danger"></i> par <a href="#">Alexandre Ribes, Développeur Web sur Perpignan</a>
        </div>
    </div>
</footer>

@yield('components')

<a href="#" id="toTop"></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
<script src="{{ elixir('js/components.js') }}"></script>
<script>
    @if( session()->has('flash_notification.message') )
        actions.alert("{!! session('flash_notification.message') !!}", '{{ session('flash_notification.level') }}');
    @endif
    app.submitForm('#newsletter-form', '#newsletter-submit');
</script>
@yield('js')
</body>
</html>
