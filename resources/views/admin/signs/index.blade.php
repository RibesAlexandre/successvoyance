@extends('layouts.admin')

@section('title', 'Horoscopes')
@section('link', route('admin.signs.index'))
@section('navbar')
    <li>
        <a href="{{ route('admin.signs.index') }}">Signes astrologiques</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <p class="pull-right">
                            <a href="{{ route('admin.signs.create_horoscope') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Rédiger un horoscope</a>
                        </p>
                        <h4 class="title">Liste des Horoscopes</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Signe</th>
                            <th class="text-center">Du</th>
                            <th class="text-center">Au</th>
                            <th class="text-center">Actions</th>
                            </thead>
                            <tbody>
                            @forelse( $horoscopes as $h )
                                <tr id="horoscope_{{ $h->id }}">
                                    <td class="text-center">{{ $h->id }}</td>
                                    <td class="text-center">{{ $h->name }}</td>
                                    <td class="text-center"><a href="{{ route('admin.signs.show', ['slug' => $h->sign->slug]) }}">{{ $h->sign->name }}</a></td>
                                    <td class="text-center">{{ $h->begin }}</td>
                                    <td class="text-center">{{ $h->ending }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.signs.edit_horoscope', ['id' => $h->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                                        <a href="{{ route('admin.signs.destroy_horoscope', ['id' => $h->id]) }}" data-action="delete" data-id="horoscope_{{ $h->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer cet horoscope ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i> Supprimer</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">Il n'y a horoscope pour le moment, cliquez <a href="{{ route('admin.signs.create_horoscope') }}">ici</a> pour créer votre premier horoscope.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center">
                    {!! $horoscopes->render() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <p class="pull-right">
                            <a href="{{ route('admin.signs.create_sign') }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Créer un signe</a>
                        </p>
                        <h4 class="title">Liste des Signes astrologiques</h4>
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
                            @forelse( $signs as $s )
                                <tr id="sign_{{ $s->id }}">
                                    <td class="text-center"><img src="{{ $s->logo }}" class="img-responsive width-30"></td>
                                    <td class="text-center"><a href="{{ route('admin.signs.show', ['slug' => $s->slug]) }}">{{ $s->name }}</a></td>
                                    <td class="text-center">{{ $s->created_date }}</td>
                                    <td class="text-center">{{ $s->updated_date }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.signs.edit_sign', ['id' => $s->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('admin.signs.destroy_sign', ['id' => $s->id]) }}" data-action="delete" data-id="sign_{{ $s->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer ce signe astrologique ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Il n'y a aucun signe astrologique pour le moment, cliquez <a href="{{ route('admin.signs.create_sign') }}">ici</a> pour créer votre premier signe astrologique.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection