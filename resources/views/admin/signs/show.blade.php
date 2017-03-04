@extends('layouts.admin')

@section('title', $sign->name)
@section('link', route('admin.signs.show', ['slug' => $sign->slug]))
@section('navbar')
    <li>
        <a href="{{ route('admin.signs.index') }}">Signes astrologiques</a>
    </li>
    <li>
        <a href="{{ route('admin.signs.show', ['slug' => $sign->slug]) }}">{{ $sign->name }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <p class="pull-right">
                    <a href="{{ route('admin.signs.create_horoscope') }}?sign={{ $sign->slug }}" class="btn btn-success btn-fill"><i class="fa fa-plus"></i> Rédiger un horoscope</a>
                </p>
                <h4 class="title">Horoscopes du {{ $sign->name }}</h4>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Nom</th>
                    <th class="text-center">Du</th>
                    <th class="text-center">Au</th>
                    <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                    @forelse( $horoscopes as $h )
                        <tr id="horoscope_{{ $h->id }}">
                            <td class="text-center">{{ $h->id }}</td>
                            <td class="text-center">{{ $h->name }}</td>
                            <td class="text-center">{{ $h->begin }}</td>
                            <td class="text-center">{{ $h->ending }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.signs.edit_horoscope', ['id' => $h->id]) }}" class="btn btn-sm btn-fill btn-info"><i class="fa fa-pencil"></i> Modifier</a>
                                <a href="{{ route('admin.signs.destroy_horoscope', ['id' => $h->id]) }}" data-action="delete" data-id="horoscope_{{ $h->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer cet horoscope ? Cette action est irréversible." class="btn btn-sm btn-fill btn-danger"><i class="fa fa-trash-o"></i> Supprimer</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">Il n'y a horoscope pour le moment, cliquez <a href="{{ route('admin.signs.create_horoscope') }}?sign={{ $sign->slug }}">ici</a> pour créer votre premier horoscope.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection