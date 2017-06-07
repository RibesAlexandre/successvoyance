@extends('layouts.app')

@section('title', 'Liste des Utilisateurs')
@section('pageTitle', 'Liste des utilisateurs')

@push('breadcrumbs')
<li class="active">Liste des utilisateurs</li>
@endpush

@section('content')
    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">
            <div class="text-center">
                <h3 class="size-30">Décrouvrez les utilisateurs inscrit sur {{ config('app.name') }}</h3>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                @foreach( $users as $user )
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img class="img-responsive" src="{{ $user->avatar() }}" alt="{{ $user->full_name }}" />
                            <div class="caption">
                                <h4 class="text-center">{{ $user->full_name }}</h4>
                                <ul class="list-inline text-center">
                                    <li><a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-success" alt="{{ $user->full_name }}">Profil</a></li>
                                    <li><a href="{{ route('users.comments', ['id' => $user->id]) }}" class="btn btn-info" alt="{{ $user->full_name }}">Commentaires</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection