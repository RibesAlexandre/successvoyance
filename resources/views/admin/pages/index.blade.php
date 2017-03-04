@extends('layouts.admin')

@section('title', 'Pages')
@section('link', route('admin.pages.index'))
@section('navbar')
    <li>
        <a href="{{ route('admin.pages.index') }}">Pages</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <p class="pull-right">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer une page</a>
                </p>
                <h4 class="title">Liste des pages</h4>
                <p class="category">Depuis cette section vous avez la possibilité de créer et/ou de modifier des pages présentes sur le site. Le contenu de la page sera rédigé directement en HTML dans l'éditeur prévu à cet effet.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Création</th>
                    <th class="text-center">Mise à jour</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @forelse( $pages as $p )
                        <tr id="page_{{ $p->id }}">
                            <td class="text-center">{{ $p->id }}</td>
                            <td class="text-center">{{ $p->name }}</td>
                            <td class="text-center">{{ $p->created }}</td>
                            <td class="text-center">{{ $p->updated }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.pages.edit', ['id' => $p->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                                <a href="{{ route('admin.pages.destroy', ['id' => $p->id]) }}" data-action="delete" data-id="page_{{ $p->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer cette page ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i> Supprimer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">Il n'y a aucune page pour le moment, cliquez <a href="{{ route('admin.pages.create') }}">ici</a> pour créer votre première page.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection