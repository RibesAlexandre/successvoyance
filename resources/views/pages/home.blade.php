@extends('layouts.app')

@section('title', 'Accueil')

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
                <ul class="shop-item-list row list-inline nomargin">
                @foreach( $consultants as $c )
                    <li class="col-lg-12">

                        <div class="shop-item clearfix">

                            <div class="thumbnail">
                                <a class="shop-item-image" href="#">
                                    <img class="img-responsive" src="{{ asset('uploads/soothsayers/' . $c['picture']) }}" alt="{{ $c['nickname'] }}" />
                                </a>
                            </div>

                            <div class="shop-item-summary">
                                <h2>{{ $c['nickname'] }}</h2>

                                <!-- rating -->
                                <div class="rating rating-{{ $c['rating'] }} size-13"><!-- rating-0 ... rating-5 --></div>
                                <!-- /rating -->

                                <p class="text-justify"><!-- product short description -->
                                    {!! nl2br(stripslashes($c['content'])) !!}
                                </p><!-- /product short description -->

                                <!-- price -->
                                <div class="shop-item-price">
                                    {{ $c['phone'] }}
                                </div>
                                <!-- /price -->
                            </div>

                        </div>

                    </li>

                @endforeach
                </ul>
                </div>
                <div class="col-md-3 hidden-sm">
                    <h3 class="hidden-xs size-16 margin-bottom-10">Conversations</h3>
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
                </div>
            </div>

        </div>
    </section>
@endsection