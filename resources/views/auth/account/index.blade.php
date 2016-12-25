@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')

    <section class="full-content">
        <h2 class="text-center">{{ Auth::user()->full_name }}</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ Auth::user()->avatar() }}" alt="{{ Auth::user()->full_name }}" class="user-avatar"><br />
                <button class="btn btn-success">Modifier</button>
            </div>
            <div class="col-md-8">
                <ul class="list-unstyled">
                    <li><strong>Nom</strong> : {{ Auth::user()->name }}</li>
                    <li><strong>Prénom</strong> : {{ Auth::user()->firstname }}</li>
                    <li><strong>Date d'inscription</strong> : {{ Auth::user()->created }}</li>
                    <li><strong>Date de naissance</strong> : {{ Auth::user()->dob }}</li>
                </ul>

                <a href="{{ route('account.edit') }}" class="btn btn-primary">Modifier mes informations</a>
            </div>
        </div>
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

@section('js')
    <script>
		$("#profile-picture").change(function(){
			app.readURL(this);
		});
    </script>
@endsection