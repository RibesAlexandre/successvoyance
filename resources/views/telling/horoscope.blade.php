@extends('layouts.app')

@section('title', $sign->name . ' - ' . $horoscope->name)
@section('pageTitle', $sign->name . ' - ' . $horoscope->name)

@push('breadcrumbs')
<li><a href="{{ route('signs.index') }}" alt="Signes Astrologiques">Signes Astrologiques</a></li>
<li><a href="{{ route('signs.show', ['sign' => $sign->slug]) }}" alt="{{ $sign->name }}">{{ $sign->name }}</a></li>
<li><a href="{{ route('signs.horoscopes', ['sign' => $sign->slug]) }}" alt="Horoscopes du signe {{ $sign->name }}">Horoscopes</a></li>
<li class="active">{{ $horoscope->name }}</li>
@endpush

@section('content')

    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-9 text-center">
                    <img class="img-responsive" src="{{ $sign->logo }}" alt="{{ $sign->name }}">
                </div>

                <div class="col-lg-9 col-md-9 col-sm-9">
                    <h2 class="size-25">{{ $horoscope->name }} <small>{{ $sign->name }} - du {{ $horoscope->begin }} au {{ $horoscope->ending }}</small></h2>
                    {!! $horoscope->content !!}
                </div>
            </div>

        </div>
    </section>


@endsection