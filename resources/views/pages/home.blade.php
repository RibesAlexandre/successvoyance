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

    <section class="info-bar info-bar-clean">
        <div class="container">

            <div class="row">

                <div class="col-sm-4">
                    <i class="glyphicon glyphicon-globe"></i>
                    <h3>FULLY RESPONSIVE</h3>
                    <p>Smarty Template is fully responsive</p>
                </div>

                <div class="col-sm-4">
                    <i class="glyphicon glyphicon-usd"></i>
                    <h3>ADMIN INCLUDED</h3>
                    <p>Smarty Template include admin</p>
                </div>

                <div class="col-sm-4">
                    <i class="glyphicon glyphicon-flag"></i>
                    <h3>ONLINE SUPPORT 24/7</h3>
                    <p>Free support via email</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <header class="margin-bottom-40 text-center">
                <h1 class="weight-300">Bienvenue sur {{ $cfg['name'] }}</h1>
                <h2 class="weight-300 letter-spacing-1 size-13"><span>Consultez la liste de nos voyants</span></h2>
            </header>

            <div class="row">
                @foreach( $consultants as $c )
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="{{ $c['picture'] }}" alt="{{ $c['nickname'] }}" class="img-responsive">
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
    </section>
@endsection