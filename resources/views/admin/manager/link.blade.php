@extends('layouts.admin')

@section('title', 'Management du Site')
@section('link', route('admin.manager.link', ['id' => $link->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.manager.index') }}">Manager</a>
    </li>
    <li>
        <a href="{{ route('admin.manager.link', ['id' => $link->id]) }}">{{ $link->name }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <p class="pull-right">
                    <a href="{{ route('admin.manager.create_link') }}?parent={{ $link->id }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer un lien</a>
                </p>
                <h4 class="title">Sous lien de {{ $link->name }}</h4>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Lien</th>
                    <th class="text-center">Position</th>
                    <th class="text-center">Parent</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody id="links-result">
                    @forelse( $link->childrens as $link )
                        @include('admin.manager.partials.table_link_index')
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">Il n'y a encore aucun lien enfant pour ce lien. Cliquez <a href="{{ route('admin.manager.create_link') }}?parent={{ $link->id }}">ici</a> pour créer son premier enfant.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
		app.orderLinks();
    </script>
@endsection