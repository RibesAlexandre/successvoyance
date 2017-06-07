@extends('layouts.admin')

@section('title', 'Liste des utilisateurs')
@section('link', route('admin.users.index'))
@section('navbar')
    <li>
        <a href="{{ route('admin.users.index') }}">Utilisateurs</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Liste des utilisateurs</h4>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Prénom</th>
                    <th class="text-center">Voyant</th>
                    <th class="text-center">Adresse email</th>
                    <th class="text-center">Inscription</th>
                    <th class="text-center">Connexion</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @foreach( $users as $user )
                    <tr>
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->firstname }}</td>
                        <td class="text-center">{{ !is_null($user->soothsayer_id) ? $user->soothsayer->nickname : null}}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->created }}</td>
                        <td class="text-center">{{ $user->connected }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.users.show', ['id' => $user->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-eye"></i> Voir</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection