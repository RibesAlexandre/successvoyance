@extends('layouts.app')

@section('title', 'Page Introuvable - Erreur 404')
@section('pageTitle', 'Page introuvable')

@push('breadcrumbs')
<li class="active">Page Introuvable</li>
@endpush

@section('content')
    <section class="padding-xlg">
        <div class="container">

            <div class="row">

                <div class="col-md-6 col-sm-6 hidden-xs">

                    <div class="error-404">
                        404
                    </div>

                </div>

                <div class="col-md-6 col-sm-6">

                    <h3 class="nomargin">Désolé, <strong>la page que vous recherchez ne semble pas exister</strong></h3>
                    <p class="nomargin-top size-20 font-lato text-muted">Vous pouvez utiliser le formulaire de recherche ci dessous, ou <a href="{{ route('contact.get') }}" alt="Nous contacter">nous contacter.</a></p>

                    <div class="inline-search clearfix margin-bottom-60">
                        <form action="{{ route('search.post') }}" method="POST" class="widget_search">
                            {{ csrf_field() }}
                            <input type="search" placeholder="Votre recherche..." id="search" name="search" class="serch-input">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            <div class="clear"></div>
                        </form>
                    </div>

                    <div class="divider nomargin-bottom"></div>

                    <a class="size-16 font-lato" href="{{ route('home') }}"><i class="glyphicon glyphicon-menu-left margin-right-10 size-12"></i> retour sur la page d'accueil !</a>

                </div>

            </div>

        </div>
    </section>

@endsection