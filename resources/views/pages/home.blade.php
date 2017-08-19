@extends('layouts.app')

@section('title', 'Accueil')

@section('metas')
    <meta http-equiv="refresh" content="60;url={{ route('home') }}">
@endsection

@section('content')

    @if( count($slides) > 1 )
    <section id="slider" class="height-400 cover-home">
        <div class="swiper-container" data-effect="slide" data-autoplay="true">
            <div class="swiper-wrapper">

                @foreach( $slides as $slide )
                    <div class="swiper-slide cover-home" style="background-image: url('{{ $slide->picture() }}');">
                        @if( !is_null($slide->title) && !is_null($slide->content) )
                            <div class="overlay dark-6"></div>
                        @endif

                        <div class="display-table">
                            <div class="display-table-cell vertical-align-middle">
                                <div class="container">

                                    <div class="row">
                                        <div class="text-center col-md-8 col-xs-12 col-md-offset-2">

                                            @if( !is_null($slide->title) )
                                            <h1 class="bold font-raleway wow fadeInUp" data-wow-delay="0.4s">{{ $slide->title }}</h1>
                                            @endif
                                            @if( !is_null($slide->content) )
                                            <p class="lead font-lato weight-300 hidden-xs wow fadeInUp" data-wow-delay="0.6s">{{ $slide->content }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>

            <div class="swiper-button-next"><i class="icon-angle-right"></i></div>
            <div class="swiper-button-prev"><i class="icon-angle-left"></i></div>
        </div>

    </section>
    @elseif( count($slides) == 1 )
        @foreach( $slides as $slide )
        <section class="height-400 cover-home" id="slider" style="background:url({{ $slide->picture() }})">
            @if( !is_null($slide->title) && !is_null($slide->content) )
            <div class="overlay dark-6"></div>
            @endif
            <div class="display-table">
                <div class="display-table-cell vertical-align-middle">
                    <div class="container text-center">
                        @if( !is_null($slide->title) )
                        <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                            {{ $slide->title }}
                        </h1>
                        @endif

                        @if( !is_null($slide->content) )
                        <p class="lead font-lato size-30 wow fadeInUp margin-top-80" data-wow-delay="0.7s">
                            {{ $slide->content }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endforeach
    @else
    <section class="height-400 cover-home" id="slider" style="background:url({{ $cfg['cover_home'] }})">
        <div class="overlay dark-6"></div>
        <div class="display-table">
            <div class="display-table-cell vertical-align-middle">
                <div class="container text-center">
                    <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                        {{ $cfg['name'] }}
                    </h1>

                    <p class="lead font-lato size-30 wow fadeInUp" data-wow-delay="0.7s">
                        {{ $cfg['description'] }}
                    </p>

                    <a class="btn btn-default btn-lg" href="#">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="info-bar info-bar-color">
        <div class="container">

            <div class="row">

                <div class="col-sm-4">
                    <i class="glyphicon glyphicon-globe"></i>
                    <h3>FREE SHIPPING &amp; RETURN</h3>
                    <p>Free shipping on all orders over $99.</p>
                </div>

                <div class="col-sm-4">
                    <i class="glyphicon glyphicon-usd"></i>
                    <h3>MONEY BACK GUARANTEE</h3>
                    <p>100% money back guarantee.</p>
                </div>

                <div class="col-sm-4">
                    <i class="glyphicon glyphicon-flag"></i>
                    <h3>ONLINE SUPPORT 24/7</h3>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div>

            </div>

        </div>
    </section>
    <section>
        <div class="container">
            {{--
            <header class="margin-bottom-40 text-center">
                <h1 class="weight-300">Bienvenue sur {{ $cfg['name'] }}</h1>
                <h2 class="weight-300 letter-spacing-1 size-13"><span>Consultez la liste de nos voyants</span></h2>
            </header>
            --}}

            <div class="row">
                <div class="col-md-9 col-sm-12">
                    {{--
                    <div class="row">
                        @foreach( $consultants as $c )
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    <img src="{{ asset('uploads/soothsayers/' . $c['picture']) }}" alt="{{ $c['nickname'] }}" class="img-responsive">
                                    <div class="caption">
                                        <h4 class="text-center">{{ $c['nickname'] }} <span class="label {{ $c['status_08'] ? 'label-success' : 'label-danger' }}">{{ $c['status_08'] ? 'Disponible' : 'Indisponible' }}</span></h4>
                                        <p class="text-justify small">{!! $c['content'] !!}</p>
                                        <button class="btn btn-success btn-block">{{ $c['phone'] }}</button>
                                    </div>
                                </div>
                            </div>
                            @if( $loop->iteration % 3 === 0 )
                    </div>
                    <div class="row">
                        @endif
                        @endforeach
                    </div>
                </div>
                --}}

                    <ul class="soothsayers">
                        @foreach( $consultants as $c )
                            <li class="soothsayer">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="left">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="{{ route('soothsayers.show', ['slug' => $c['slug']]) }}">
                                                        <img class="media-object" src="{{ asset('uploads/soothsayers/' . $c['picture']) }}" alt="{{ $c['nickname'] }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <ul class="list-inline skills">
                                                        <li>{{ $c['comments'] }} <i class="fa fa-comments" data-toggle="tooltip" data-placement="bottom" title="{{ $c['comments'] . ' ' . str_plural('commentaire', $c['comments']) }}"></i></li>
                                                        <li>{{ $c['favorites'] }} <i class="fa fa-star" data-toggle="tooltip" data-placement="bottom" title="{{ $c['favorites'] . ' ' . str_plural('utilisateur', $c['favorites']) .  ' l\'ont marqué en favori'  }}"> </i></li>
                                                        <li>{{ $c['total'] }} <i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="{{ $c['total'] . ' ' . str_plural('consultation', $c['total']) }}"></i></li>
                                                    </ul>
                                                    <a href="{{ route('soothsayers.show', ['slug' => $c['slug']]) }}" alt="{{ $c['nickname'] }}"><h4 class="media-heading">{{ $c['nickname'] }}</a> <div class="rating rating-{{ $c['rating'] }} size-20 margin-bottom-20 inline-block"></div></h4>
                                                    <p class="text-justify">{!! nl2br(stripslashes($c['content'])) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 contact">
                                        @include('soothsayers.partials.status', ['c' => $c])

                                        @if( isset($c['tarif_cb']) && $c['tarif_cb'] != 0 )
                                            <div class="margin-top-20">
                                                <p class="size-16 bold">{{ $c['tarif_cb'] }} € / min</p>
                                            </div>
                                        @endif

                                        @if( isset($c['next_dispo_cb']) )
                                            <strong>{{ $c['next_dispo_cb'] }}</strong>
                                        @endif

                                        @if( isset($c['next_dispo_08']) )
                                            <strong>{{ $c['next_dispo_08'] }}</strong>
                                        @endif

                                        @if( isset($c['code']) && !is_null($c['code']) )
                                            <div class="margin-top-20">
                                                <p class="size-16 bold"><strong>Code</strong> {{ $c['code'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 hidden-sm">

                    @if( count($favorites) > 0 )
                    <h3 class="hidden-xs size-16 margin-bottom-10">Mes voyant(e)s favori(e)s</h3>
                    <ul class="soothsayers">
                        @foreach( $favorites as $f )
                        <li class="soothsayer border-box">
                            <div class="media">
                                <div class="media-left">
                                    <a href="{{ route('soothsayers.show', ['slug' => $f['slug']]) }}" alt="{{ $f['nickname'] }}">
                                        <img class="media-object width-40 img-circle" src="{{ asset('uploads/soothsayers/' . $f['picture']) }}" alt="{{ $f['nickname'] }}">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ $f['nickname'] }} <div class="rating rating-{{ $f['rating'] }} size-13"></div></h4>
                                    <div class="size-18 text-left padding-bottom-10">@include('soothsayers.partials.status', ['c' => $f])</div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif

                    @if( count($comments) > 0)
                    <h3 class="hidden-xs size-16 margin-bottom-10">Derniers Commentaires</h3>
                    <div class="nomargin-top margin-bottom-30 border-box">
                        <div class="margin-bottom-0 margin-top-10">
                            @forelse( $comments as $c )
                                <div class="row tab-post"><!-- post -->
                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                        <a href="{{ $c->url() }}">
                                            <img src="{{ $c->user->avatar() }}" width="50" alt="{{ $c->user->full_name }}" />
                                        </a>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                        <a href="{{ $c->url() }}" class="tab-post-link">{{ str_limit($c->content, 50, '...') }}</a>
                                        <small>{{ $c->created_ago }}</small>
                                    </div>
                                </div>
                            @empty
                            <p class="text-center">Aucun commentaire</p>
                            @endforelse
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                            <a href="{{ route('telling.email') }}" alt="Voyance par email !">
                                <div class="box-icon box-icon-center box-icon-round box-icon-transparent box-icon-large box-icon-content box-voyance margin-bottom-30">
                                    <div class="box-icon-title">
                                        <i class="fa fa-exclamation"></i>
                                        <h2>Contactez nos voyant(e)s !</h2>
                                    </div>
                                    <p>Des questions sur votre avenir ? N'hésitez pas à contacter nos voyant(e)s pour éclaircir vos craintes !</p>
                                </div>
                            </a>

                        </div>
                    </div>

                        @if( count($topics) > 0 && count($topicsHot) > 0 )
                        <h3 class="hidden-xs size-16 margin-bottom-10">Dernières Conversations</h3>
                        <div class="tabs nomargin-top margin-bottom-0 border-box">

                            <!-- tabs -->
                            <ul class="nav nav-tabs nav-bottom-border nav-justified">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab">
                                        Récentes
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_2" data-toggle="tab">
                                        Populaires
                                    </a>
                                </li>
                            </ul>

                            <!-- tabs content -->
                            <div class="tab-content margin-bottom-0 margin-top-10">
                                <div id="tab_1" class="tab-pane active">
                                    @foreach( $topics as $t )
                                        <div class="row tab-post"><!-- post -->
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a href="blog-sidebar-left.html">
                                                    <img src="{{ $t->user->avatar() }}" width="50" alt="{{ $t->user->full_name }}" />
                                                </a>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <a href="blog-sidebar-left.html" class="tab-post-link">{{ $t->title }}</a>
                                                <small>{{ Date::parse($t->created_at)->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="tab_2" class="tab-pane">
                                    @foreach( $topicsHot as $t )
                                        <div class="row tab-post"><!-- post -->
                                            <div class="col-md-3 col-sm-3 col-xs-3">
                                                <a href="blog-sidebar-left.html">
                                                    <img src="{{ $t->user->avatar() }}" width="50" alt="{{ $t->user->full_name }}" />
                                                </a>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <a href="blog-sidebar-left.html" class="tab-post-link">{{ $t->title }}</a>
                                                <small>{{ Date::parse($t->created_at)->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>

        </div>
    </section>
@endsection