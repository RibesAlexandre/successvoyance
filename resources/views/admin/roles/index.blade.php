@extends('layouts.admin')

@section('title', 'Rôles')
@section('link', route('admin.roles.index'))
@section('navbar')
    <li>
        <a href="{{ route('admin.roles.index') }}">Rôles</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <p class="pull-right">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer un rôle</a>
                </p>
                <h4 class="title">Liste des rôles</h4>
                <p class="category">Depuis cette page vous avez la possibilité de gérer tous les administratifs du site. <span class="text-danger">Soyez sûrs de vous lorsque vous supprimer un rôle, cela pourrait restreindre vos niveaux d'autorisations</span>.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Slug</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @forelse( $roles as $r )
                    <tr id="role_{{ $r->id }}">
                        <td class="text-center">{{ $r->id }}</td>
                        <td class="text-center">{{ $r->name }}</td>
                        <td class="text-center">{{ $r->slug }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.roles.edit', ['id' => $r->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                            <a href="{{ route('admin.roles.destroy', ['id' => $r->id]) }}" data-action="delete" data-id="role_{{ $r->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer ce rôle ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i> Supprimer</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="4">Il n'y a aucun rôle pour le moment, créez en !</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection