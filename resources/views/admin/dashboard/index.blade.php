@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('link', route('admin.index'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="content">
                        <h2><i class="fa fa-users"></i></h2>
                        <div class="footer">
                            <div class="legend">
                                {{ $users }} utilisateurs
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="content">
                        <h2><i class="fa fa-sticky-note"></i></h2>
                        <div class="footer">
                            <div class="legend">
                                {{ $topics }} sujets
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="content">
                        <h2><i class="fa fa-envelope"></i></h2>
                        <div class="footer">
                            <div class="legend">
                                {{ $posts }} messages
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection