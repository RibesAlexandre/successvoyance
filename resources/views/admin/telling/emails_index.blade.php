@extends('layouts.admin')

@section('title', 'Offres Emails Voyance')
@section('link', route('admin.emails.index'))
@section('navbar')
    <li>
        <a href="{{ route('admin.emails.index') }}">Offres Emails Voyance</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <p class="pull-right">
                    <a href="{{ route('admin.emails.create') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer une offre Email</a>
                </p>
                <h4 class="title">Liste des offres</h4>
                <p class="category">Depuis cette section vous avez la possibilité de créer et/ou de modifier des offres emails de voyance présentes sur le site. Le contenu de l'offre sera rédigé directement en HTML dans l'éditeur prévu à cet effet.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Montant</th>
                    <th class="text-center">Quantité</th>
                    <th class="text-center">Populaire</th>
                    <th class="text-center">Active</th>
                    <th class="text-center">Création</th>
                    <th class="text-center">Mise à jour</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @forelse( $emails as $e )
                        <tr id="email_{{ $e->id }}">
                            <td class="text-center">{{ $e->id }}</td>
                            <td class="text-center">{{ $e->name }}</td>
                            <td class="text-center">{{ $e->amount_price }}€</td>
                            <td class="text-center">{{ $e->quantity }}</td>
                            <td class="text-center">{{ $e->popular ? 'Oui' : 'Non' }}</td>
                            <td class="text-center">{{ $e->enabled ? 'Oui' : 'Non' }}</td>
                            <td class="text-center">{{ $e->created }}</td>
                            <td class="text-center">{{ $e->updated }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.emails.edit', ['id' => $e->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                                <a href="{{ route('admin.emails.destroy', ['id' => $e->id]) }}" data-action="delete" data-id="page_{{ $e->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer cette offre ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i> Supprimer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">Il n'y a aucune offre pour le moment, cliquez <a href="{{ route('admin.emails.create') }}">ici</a> pour créer votre première page.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection