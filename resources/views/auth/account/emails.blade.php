@extends('layouts.app')

@section('title', 'Mes emails de voyance')

@push('breadcrumbs')
<li><a href="{{ route('account') }}" alt="Mon compte">Mon compte</a></li>
<li class="active">Mes emails de voyance</li>
@endpush
@section('pageTitle', 'Mes emails de voyance')

@section('content')
    <section>
        <div class="container">

            <div class="col-lg-3 col-md-3 col-sm-4">
                @include('auth.account.partials.menu')
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8">
                @include('auth.account.partials.flipbox', ['icon' => 'fa-inbox', 'title' => 'Mes emails de voyance'])

                <div class="box-light">
                    <div class="box-inner">
                        @if( $total > 0 )
                        <p class="text-center size-50 bold text-primary uppercase">{{ $total }} {{ str_plural('email', $total) }} {{ str_plural('restant', $total) }}</p>
                            <p class="text-center small">Il vous reste {{ $total }} {{ str_plural('email', $total) }} pour pouvoir communiquer avec nos voyants. Pour ne pas tomber à court d'emails, vous pouvez acheter des packs supplémentaires en vous rendant sur <a href="{{ route('telling.email') }}?order=1" alt="Acheter de nouveaux emails de voyance !">cette page</a></p>
                        @else
                            <p class="text-center size-60 bold text-danger">Réserve d'emails épuisée !</p>
                            <p class="text-center">Il ne vous reste plus d'emails pour répondre à nos voyants ! Pour pouvoir continuer à communiquer, achetez un nouveau pack d'email en vous rendant sur <a href="{{ route('telling.email') }}" alt="Acheter de nouveaux emails de voyance !">cette page</a></p>
                        @endif
                    </div>
                </div>

                <div class="box-light">
                    <div class="box-inner">
                        @if( count($emails) > 0 )
                        <div class="timeline">
                            @foreach( $emails as $email )
                                <div class="timeline-item timeline-item-bordered">
                                    <div class="timeline-entry rounded"><!-- .rounded = entry -->
                                        {{ Date::parse($email->created_at)->format('d') }}<span>{{ Date::parse($email->created_at)->format('M') }}</span>
                                        <div class="timeline-vline"></div>
                                    </div>

                                    <h2 class="uppercase">
                                        <p class="pull-right">{{ count($email->responses) }} {{ str_plural('réponse', count($email->responses)) }}</p>
                                        <a href="{{ route('account.email', ['identifier' => $email->identifier]) }}" alt="{{ $email->topic }}">{{ $email->topic }}</a>
                                    </h2>
                                    <p>{!! nl2br(str_limit($email->content, 200, '...')) !!}</p>
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div class="alert alert-primary text-center">Vous n'avez envoyé aucun email à nos voyants, pour envoyer des emails, rendez vous sur <a href="{{ route('telling.email') }}" alt="Contactez nos voyant(e)s !" class="bold">cette page</a>.</div>
                        @endif

                        <div class="text-center">{!! $emails->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection