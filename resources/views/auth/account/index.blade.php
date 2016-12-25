@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')

    <section class="full-content">
        <h3 class="text-center">{{ Auth::user()->full_name }}</h3>
    </section>

    {{--
    <section id="content">
        <h3>{{ Auth::user()->full_name }}</h3>
    </section>
    <aside id="aside">
        <div class="list-group">
            <a href="{{ route('account') }}" class="list-group-item active">Mon compte</a>
            <a href="{{ route('account.edit') }}" class="list-group-item">Mes informations</a>
            <a href="{{ route('account.password') }}" class="list-group-item">Mon mot de passe</a>
            <a href="{{ route('account.delete') }}" class="list-group-item">Supprimer mon compte</a>
        </div>
    </aside>
    --}}
@endsection