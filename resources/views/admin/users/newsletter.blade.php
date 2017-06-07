@extends('layouts.admin')

@section('title', 'Liste des emails en newsletter')
@section('link', route('admin.newsletter'))
@section('navbar')
    <li>
        <a href="{{ route('admin.newsletter') }}">Newsletter</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">
                    <p class="pull-right">
                        <a href="{{ route('admin.newsletter.dl') }}" class="btn btn-primary btn-fill"><i class="fa fa-download"></i> Fichier CSV</a>
                    </p>
                    Liste des emails
                </h4>
            </div>
            <div class="content">
                <div class="alert alert-danger">
                    Pensez à inclure ce lien dans toutes vos newsletter pour que les utilisateurs puissent se désabonner : http://successvoyance.dev/newsletter/desinscription
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Adresse email</th>
                    </thead>
                    <tbody>
                    @foreach( $emails as $key => $value )
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $value }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection