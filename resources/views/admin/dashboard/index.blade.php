@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('link', route('admin.index'))

@section('content')
    <div class="container-fluid all-icons">
        <div class="row">
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-eye"></i>
                    <span><strong>{{ $soothsayers }}</strong> voyants</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-file-text"></i>
                    <span><strong>{{ $horoscopes }}</strong> horoscopes</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-users"></i>
                    <span><strong>{{ $users }}</strong> utilisateurs</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-paper-plane"></i>
                    <span><strong>{{ $newsletter }}</strong> inscriptions à la newsletter</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-credit-card"></i>
                    <span><strong>{{ $payments }}</strong> transactions</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-sticky-note"></i>
                    <span><strong>{{ $topics }}</strong> sujets</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-envelope"></i>
                    <span><strong>{{ $posts }}</strong> messages</span>
                </div>
            </div>
            <div class="font-icon-list col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="font-icon-detail"><i class="fa fa-comment"></i>
                    <span><strong>{{ $comments }}</strong> commentaires</span>
                </div>
            </div>
        </div>
    </div>
@endsection