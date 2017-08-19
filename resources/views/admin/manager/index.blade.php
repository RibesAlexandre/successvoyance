@extends('layouts.admin')

@section('title', 'Management du Site')
@section('link', route('admin.manager.index'))
@section('navbar')
    <li>
        <a href="{{ route('admin.manager.index') }}">Manager</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs nav-tabs-justified nav-justified">
            <li class="active"><a href="#config" data-toggle="tab">Configuration</a></li>
            <li><a href="#images" data-toggle="tab">Images</a></li>
            <li><a href="#manager" data-toggle="tab">Éléments</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade in active" id="config">
                <div class="card" style="padding: 20px;">
                    {!! BootForm::openHorizontal(['sm' => [4, 8],'lg' => [2, 10]])->action( route('admin.manager.update_config') )->id('config-form')->post() !!}
                    @foreach( $config as $cfg )
                        @if( $cfg->type == 'string' )
                            {!! BootForm::text(trans('success.' . $cfg->key), str_slug($cfg->key), $cfg->value) !!}
                        @elseif( $cfg->type == 'boolean' )
                            {!! BootForm::checkbox(trans('success.' . $cfg->key), str_slug($cfg->key), 1, $cfg->value) !!}
                        @elseif( $cfg->type == 'integer' )
                            {!! BootForm::number(trans('success.' . $cfg->key), str_slug($cfg->key), $cfg->value)->min(0) !!}
                        @endif
                    @endforeach
                    {!! BootForm::submit('Mettre à jour', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                    {!! BootForm::close() !!}
                </div>
            </div>
            <div class="tab-pane fade" id="images">
                <div class="card" style="padding: 20px;">
                    {!! BootForm::openHorizontal(['sm' => [4, 8],'lg' => [2, 10]])->action( route('admin.manager.upload') )->id('file-form')->post()->files() !!}
                    {!! BootForm::text('Nom de l\'image', 'design_name') !!}
                    {!! BootForm::file('Image à uploader', 'design_file') !!}
                    {!! BootForm::submit('Uploader l\'image', 'btn btn-success btn-block btn-fill')->id('btn-file') !!}
                    {!! BootForm::close() !!}
                </div>

                <div class="row" id="cards_pictures">
                @foreach( $files as $file )
                    @include('admin.manager.partials.card_picture')
                @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="manager">
                <div class="card" style="padding: 20px;">
                    <h2 class="text-center">Gestion des éléments du site</h2>
                    <p class="lead text-center">Depuis cette page vous avez la possibilité de gérer les différents éléments du site, à commencer par le menu, les carousels, les liens, etc.</p>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="header">
                                <p class="pull-right">
                                    <a href="{{ route('admin.manager.create_link') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer un lien</a>
                                </p>
                                <h4 class="title">Liens du site</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Lien</th>
                                    <th class="text-center">Position</th>
                                    <th class="text-center">Conteneur</th>
                                    <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody id="links-result">
                                    @forelse( $links as $link )
                                        @include('admin.manager.partials.table_link_index')
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Il n'y a encore aucun lien d'enregistré sur le site. Cliquez <a href="{{ route('admin.manager.create_link') }}">ici</a> pour créer le premier lien.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="header">
                                <p class="pull-right">
                                    <a href="{{ route('admin.manager.create_carousel') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer un carousel</a>
                                </p>
                                <h4 class="title">Carousels du site</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Titre</th>
                                    <th class="text-center">Lien</th>
                                    <th class="text-center">Début</th>
                                    <th class="text-center">Fin</th>
                                    <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    @forelse( $carousels as $c )
                                        <tr id="carousel_{{ $c->id }}">
                                            <td class="text-center"><img src="{{ $c->picture() }}" class="img-responsive width-30 center-block"></td>
                                            <td class="text-center">{{ $c->title }}</td>
                                            <td class="text-center"><a href="{{ $c->link }}" target="_blank">{{ str_limit($c->link, 20) }}</a></td>
                                            <td class="text-center">{{ $c->begin }}</td>
                                            <td class="text-center">{{ $c->ending }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.manager.order', ['id' => $c->id, 'asc' => 'up', 'type' => 'carousel']) }}" class="btn btn-xs btn-fill btn-default" data-action="order" data-asc="up" data-div="carousel"><i class="fa fa-caret-up"></i></a>
                                                <a href="{{ route('admin.manager.order', ['id' => $c->id, 'asc' => 'down', 'type' => 'carousel']) }}" class="btn btn-xs btn-fill btn-default" data-action="order" data-asc="down" data-div="carousel"><i class="fa fa-caret-down"></i></a>
                                                <a href="{{ route('admin.manager.edit_carousel', ['id' => $c->id]) }}" class="btn btn-xs btn-fill btn-info"><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.manager.destroy_carousel', ['id' => $c->id]) }}" data-action="delete" data-id="carousel_{{ $c->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer ce carousel ? Cette action est irréversible." class="btn btn-xs btn-fill btn-danger"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">Il n'y a encore aucun carousel d'enregistré sur le site. Cliquez <a href="#">ici</a> pour créer le premier carousel.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <p class="pull-right">
                                    <a href="" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer un block</a>
                                </p>
                                <h4 class="title">Blocks du site</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Lien</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Début</th>
                                    <th class="text-center">Fin</th>
                                    <th class="text-center">Conteneur</th>
                                    <th class="text-center">Actions</th>
                                    </thead>
                                    <tbody>
                                    @forelse( $blocks as $b )
                                        <tr id="block_{{ $b->id }}">
                                            <td class="text-center">{{ $b->id }}</td>
                                            <td class="text-center">{{ $b->name }}</td>
                                            <td class="text-center"><a href="{{ $b->link }}" target="_blank">{{ str_limit($b->link, 20) }}</a></td>
                                            <td class="text-center">{{ $b->background }}</td>
                                            <td class="text-center">{{ $b->begin }}</td>
                                            <td class="text-center">{{ $b->ending }}</td>
                                            <td class="text-center">{{ ucfirst($b->container) }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.manager.edit_link', ['id' => $b->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                                                <a href="{{ route('admin.manager.destroy_link', ['id' => $b->id]) }}" data-action="delete" data-id="block_{{ $b->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer ce block ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i> Supprimer</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="8">Il n'y a encore aucun block d'enregistré sur le site. Cliquez <a href="#">ici</a> pour créer le premier block.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        app.orderLinks();
		app.submitForm('#file-form', '#btn-file');
        app.submitForm('#config-form', '#btn-submit');
    </script>
@endsection