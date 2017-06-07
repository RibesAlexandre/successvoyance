@extends('layouts.app')

@section('title', $sign->name . ' - Derniers horocopes')
@section('pageTitle', $sign->name . ' - Derniers horocopes')

@push('breadcrumbs')
<li><a href="{{ route('signs.index') }}" alt="Signes Astrologiques">Signes Astrologiques</a></li>
<li><a href="{{ route('signs.show', ['sign' => $sign->slug]) }}" alt="{{ $sign->name }}">{{ $sign->name }}</a></li>
<li class="active">Horoscopes</li>
@endpush

@section('content')

    <section>
        <div class="container">
            @include('telling.sign_box')

            <div class="divider divider-circle divider-color divider-center">
                <i class="fa fa-star"></i>
            </div>

            <div class="box-inner" id="horoscopes">
                @if( count($horoscopes) > 0 )
                <div class="timeline timeline-inverse">
                   @foreach( $horoscopes as $horoscope )
                    <div class="timeline-item timeline-item-bordered">

                        <div class="timeline-entry rounded">
                            {{ Date::parse($horoscope->begin_at)->format('d') }}<span>{{ Date::parse($horoscope->begin_at)->format('F') }}</span>
                            <div class="timeline-vline"></div>
                        </div>

                        <h2 class="uppercase bold size-17"><a href="{{ route('signs.horoscope', ['sign' => $sign->name, 'slug' => $horoscope->slug]) }}" alt="{{ $horoscope->name }}">{{ $horoscope->name }}</a> <small>Du {{ $horoscope->begin }} au {{ $horoscope->ending }}</small></h2>
                        {!! $horoscope->content !!}
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="alert alert-warning text-center">Il n'y a actuellement aucun horoscope pour le signe {{ $sign->name }}. Pour ne rien rater sur votre signe astrologique, et recevoir votre horoscope directement dans votre boîte email, renseignez votre date de naissance dans votre <a href="{{ route('account.edit') }}">espace membre</a>.</div>
                @endif
            </div>

            <div class="text-center">{!! $horoscopes->links() !!}</div>
        </div>
    </section>

@endsection