<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title') :: Administration</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ elixir('css/admin.css') }}" rel="stylesheet"/>
    <link href="{{ elixir('css/components.css') }}" rel="stylesheet">

    <!--     Fonts and icons     -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    <!--    Others JS Files     -->
    @yield('css')

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="{{ asset('imgs/admin/design/sidebar-5.jpg') }}">

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ route('home') }}" class="simple-text">
                    {{ config('app.name') }}
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{ route('admin.index') }}">
                        <i class="fa fa-tachometer"></i>
                        <p>Tableau de bord</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.roles.index') }}">
                        <i class="fa fa-key"></i>
                        <p>Rôles</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="@yield('link')">@yield('title')</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="{{ route('admin.index') }}">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        @yield('navbar')
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->fullName }} <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('account') }}">Mon compte</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            @yield('content')
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">
                                Accueil
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Tableau de bord
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Forums
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Horoscope
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2016 - {{ Date::now()->format('Y') }} Success Voyance - Réalisé avec <i class="fa fa-heart text-danger"></i> par <a href="http://alexandre-ribes.fr">Alexandre Ribes, Développeur Web sur Perpignan</a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{ elixir('js/app.js') }}"></script>
<script src="{{ elixir('js/admin.js') }}"></script>
<script src="{{ elixir('js/components.js') }}"></script>
@yield('js')

</html>
