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
                        <li><a tabindex="-1" href="#"><i class="fa fa-bookmark"></i> MY WISHLIST</a></li>
                        <li><a tabindex="-1" href="#"><i class="fa fa-edit"></i> MY REVIEWS</a></li>
                        <li><a tabindex="-1" href="#"><i class="fa fa-cog"></i> MY SETTINGS</a></li>
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

                <div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
                    <nav class="nav-main">
                        <ul id="topMain" class="nav nav-pills nav-main">
                            <li><a href="#">Accueil</a></li>
                            <li><a href="#">Horoscope</a></li>
                            <li><a href="#">Forum</a></li>
                            <li><a href="#">Voyance</a></li>
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
                <!-- Footer Logo -->
                Success Voyance

                <!-- Small Description -->
                <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>

                <!-- Contact Address -->
                <address>
                    <ul class="list-unstyled">
                        <li class="footer-sprite address">
                            Success Voyance<br>
                            6 rue des Tartampions<br>
                            66000 Bompas<br>
                        </li>
                        <li class="footer-sprite phone">
                            Phone: 07.09.09.09.09
                        </li>
                        <li class="footer-sprite email">
                            <a href="#">contact@successvoyance.fr</a>
                        </li>
                    </ul>
                </address>
                <!-- /Contact Address -->

            </div>

            <div class="col-md-3">

                <!-- Latest Blog Post -->
                <h4 class="letter-spacing-1">Dernières conversations</h4>
                <ul class="footer-posts list-unstyled">
                    <li>
                        <a href="#">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue</a>
                        <small>29 June 2015</small>
                    </li>
                    <li>
                        <a href="#">Nullam id dolor id nibh ultricies</a>
                        <small>29 June 2015</small>
                    </li>
                    <li>
                        <a href="#">Duis mollis, est non commodo luctus</a>
                        <small>29 June 2015</small>
                    </li>
                </ul>
                <!-- /Latest Blog Post -->

            </div>

            <div class="col-md-2">

                <!-- Links -->
                <h4 class="letter-spacing-1">EXPLORE SMARTY</h4>
                <ul class="footer-links list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Our Clients</a></li>
                    <li><a href="#">Our Pricing</a></li>
                    <li><a href="#">Smarty Tour</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
                <!-- /Links -->

            </div>

            <div class="col-md-4">

                <!-- Newsletter Form -->
                <h4 class="letter-spacing-1">Restez connecté !</h4>
                <p>Inscrivez vous à notre newsletter pour profiter de nos promotions et des nouveautés du site.</p>

                <form class="validate" action="{{ route('newsletter.post') }}" method="post" data-success="Subscribed! Thank you!" data-toastr-position="bottom-right" id="newsletter-form">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" id="newsletter_email" name="newsletter_email" class="form-control required" placeholder="Votre adresse emil">
                        <span class="input-group-btn">
                                <button class="btn btn-success" type="submit" id="newsletter-submit">S'inscrire !</button>
                            </span>
                    </div>
                </form>
                <!-- /Newsletter Form -->

                <!-- Social Icons -->
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

                    <a href="#" class="social-icon social-icon-border social-rss pull-left" data-toggle="tooltip" data-placement="top" title="Rss">
                        <i class="fa fa-rss"></i>
                        <i class="fa fa-rss"></i>
                    </a>

                </div>
                <!-- /Social Icons -->

            </div>

        </div>

    </div>

    <div class="copyright">
        <div class="container">
            <ul class="pull-right nomargin list-inline mobile-block">
                <li><a href="#">Conditions d'utilisations</a></li>
                <li>&bull;</li>
                <li><a href="#">CGV</a></li>
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
