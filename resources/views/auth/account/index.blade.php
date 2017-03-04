@extends('layouts.app')

@section('title', Auth::check() && Auth::id() == $user->id ? 'Mon compte' : 'Profil public de ' . $user->full_name)

@push('breadcrumbs')
    @if( Auth::check() && Auth::id() == $user->id )
        <li>Mon compte</li>
    @else
        <li>Profil de {{ $user->full_name }}</li>
    @endif
@endpush

@section('content')
    <section>
        <div class="container">

            <div class="col-lg-3 col-md-3 col-sm-4">
                @include('auth.account.partials.menu')
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8">
                <div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center nomargin">
                    <div class="front">
                        <div class="box1 noradius">
                            <div class="box-icon-title">
                                <i class="fa fa-user"></i>
                                <h2>{{ $user->full_name }}</h2>
                            </div>
                            <p>Passez votre curseur par dessus ce block pour découvrir sa présentation.</p>
                        </div>
                    </div>

                    <div class="back">
                        <div class="box2 noradius">
                            <h4>Qui est {{ $user->full_name }} ?</h4>
                            <hr />
                            @if( !is_null($user->biography) )
                                <p>{!! $user->biography !!}</p>
                            @else
                                @if( Auth::check() && Auth::id() == $user->id )
                                    <p>Vous n'avez pas rédigé votre block de présentation, <a href="#" class="bold text-white">cliquez ici</a> pour rédiger une petite présentation.</p>
                                @else
                                    {{ $user->full_name }} n'a pas encore rédigé sa présentation.
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                @if( $user->can_contact && Auth::check() && Auth::user()->id != $user->id )
                <form method="post" action="#" class="box-light margin-top-20"><!-- .box-light OR .box-dark -->
                    <div class="box-inner">
                        <h4 class="uppercase">Laissez un message à <strong>{{ $user->full_name }}</strong></h4>

                        <textarea required name="message" class="form-control word-count" data-maxlength="100" rows="5" placeholder="Votre message"></textarea>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Envoyer votre message</button>
                    </div>
                </form>
                @endif

            </div>

        </div>
    </section>

@endsection