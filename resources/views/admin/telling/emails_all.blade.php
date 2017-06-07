@extends('layouts.admin')

@section('title', 'Emails Voyance')
@section('link', route('admin.emails.all'))
@section('navbar')
    <li>
        <a href="{{ route('admin.emails.all') }}">Emails Voyance</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Liste des emails</h4>
                <p class="category">Depuis cette section vous avez la possibilité de consulter la conversation d'emails Voyance, et d'apporter une réponse aux emails.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Sujet</th>
                    <th class="text-center">Utilisateur</th>
                    <th class="text-center">Identifiant</th>
                    <th class="text-center">Création</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @forelse( $emails as $e )
                        <tr id="email_{{ $e->id }}">
                            <td class="text-center">{{ $e->id }}</td>
                            <td class="text-center">{{ $e->topic }}</td>
                            <td class="text-center">{{ $e->user->full_name }}</td>
                            <td class="text-center">{{ $e->identifier }}</td>
                            <td class="text-center">{{ $e->created }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.emails.conversation', ['identifier' => $e->identifier]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-eye"></i> Consulter</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">Il n'y a aucun email de voyance pour le moment. N'hésitez pas à promouvoir le service !</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection