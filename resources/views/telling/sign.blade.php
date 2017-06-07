@extends('layouts.app')

@section('title', $sign->name)
@section('pageTitle', $sign->name)

@push('breadcrumbs')
<li><a href="{{ route('signs.index') }}" alt="Signes Astrologiques">Signes Astrologiques</a></li>
<li class="active">{{ $sign->name }}</li>
@endpush

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <img class="img-responsive" src="{{ $sign->logo }}" alt="{{ $sign->name }}">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <h2 class="size-25">{{ $sign->name }} <small>Du {{ $sign->sign_begin_date }} au {{ $sign->sign_ending_date }}</small></h2>
                    {!! $sign->content !!}

                    <hr>

                    @if( !is_null($horoscope) )
                    <h2 class="size-25">Dernier horoscope <small>Du {{ $horoscope->begin }} au {{ $horoscope->ending }}</small></h2>
                    {!! $horoscope->content !!}

                    <hr>
                    @endif

                    <p class="text-center">
                        <a href="{{ route('signs.horoscopes', ['sign' => $sign->slug]) }}" alt="Voir tous les horoscopes" class="btn btn-success"><i class="fa fa-eye"></i> Voir tous les horoscopes</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="nopadding">
        <div class="callout callout-theme-color">
            <div class="row">
                <div class="col-md-9">
                    <h3>Des questions sur votre signe astrologique ?</h3>
                    <p>Contactez un de nos voyants par email pour en savoir plus !</p>
                </div>
                <div class="col-md-3 text-right">
                    <a href="{{ route('telling.email') }}" class="btn btn-primary btn-lg">En savoir plus !</a>
                </div>
            </div>
        </div>
    </section>
    @include('telling.signs_box')

@endsection