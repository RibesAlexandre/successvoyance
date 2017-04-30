@extends('layouts.app')

@section('title', 'Accueil')

@section('metas')
    <meta http-equiv="refresh" content="60;url={{ route('home') }}">
@endsection

@section('content')
    <section class="height-500" id="slider" style="background:url({{ $cfg['cover_home'] }})">
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
    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">

            <div class="text-center">
                <h3 class="size-30">Smarty Multipurpose Responsive Template</h3>
                <p>We can't solve problems by using the same kind of thinking we used when we created them.</p>
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
                                                    <a href="#">
                                                        <img class="media-object" src="{{ asset('uploads/soothsayers/' . $c['picture']) }}" alt="{{ $c['nickname'] }}">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <ul class="list-inline skills">
                                                        <li>{{ $c['comments'] }} <i class="fa fa-comments" data-toggle="tooltip" data-placement="bottom" title="{{ $c['comments'] . ' ' . str_plural('commentaire', $c['comments']) }}"></i></li>
                                                        <li>{{ $c['favorites'] }} <i class="fa fa-star" data-toggle="tooltip" data-placement="bottom" title="{{ $c['favorites'] . ' ' . str_plural('utilisateur', $c['favorites']) .  ' l\'ont marqué en favori'  }}"> </i></li>
                                                        <li>{{ $c['total'] }} <i class="fa fa-eye" data-toggle="tooltip" data-placement="bottom" title="{{ $c['total'] . ' ' . str_plural('consultation', $c['total']) }}"></i></li>
                                                    </ul>
                                                    <a href="{{ route('soothsayers.show', ['slug' => $c['slug']]) }}" alt="{{ $c['nickname'] }}"><h4 class="media-heading">{{ $c['nickname'] }}</a></h4>
                                                    <p class="text-justify">{!! nl2br(stripslashes($c['content'])) !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 contact">
                                        {{ $c['next_dispo_cb'] }} {{ $c['next_dispo_08'] }}
                                        <div class="rating rating-{{ $c['rating'] }} size-28 margin-bottom-20"></div>
                                        @if( $c['status_08'] )
                                            <div class="label label-success"><i class="fa fa-phone"></i> {{ $c['phone'] }}</div>
                                        @elseif( $c['status_cb'] )
                                            <div class="label label-success"><i class="fa fa-phone"></i> {{ $c['phone'] }}</div>
                                        @elseif( !$c['status_cb'] && ! $c['status_08'] )
                                            <div class="label label-danger">Indisponible</div>
                                        @else
                                            <div class="label label-success"><i class="fa fa-phone"></i> {{ $c['phone'] }}</div>
                                        @endif

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
                    <h3 class="hidden-xs size-16 margin-bottom-10">Dernières Conversations</h3>
                    <div class="tabs nomargin-top margin-bottom-60">

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
                        <div class="tab-content margin-bottom-60 margin-top-30">
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
                                            <small>{{ $t->created_at }}</small>
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
                                            <small>{{ $t->created_at }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <h3 class="hidden-xs size-16 margin-bottom-10">Derniers Commentaires</h3>
                    <div class="nomargin-top margin-bottom-60">
                        <div class="margin-bottom-60 margin-top-30">
                            @foreach( $comments as $c )
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection