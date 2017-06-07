@extends('layouts.app')

@section('title', 'Voyance par email')
@section('pageTitle', 'Contactez nos voyants par email')

@push('breadcrumbs')
<li class="active">Voyance par email</li>
@endpush

@section('content')

    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">
            <div class="text-center">
                <h3 class="size-30">Entrez en contact avec nos voyant(e)s</h3>
                <p>Remplissez le formulaire pour envoyer un email à un de nos voyants, il vous répondra le plus rapidement possible !</p>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="col-md-9 col-sm-9">

                <h3>Posez votre question à nos voyants !</h3>

                <form action="{{ route('telling.email.post') }}" method="POST" id="form-telling">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="topic">Sujet de votre conversation</label>
                                    <input type="text" value="{{ old('topic') }}" class="form-control" name="topic" id="topic">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="content">Contenu de votre conversation *</label>
                                    <textarea required rows="8" class="form-control" name="content" id="content"></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" id="submit-telling"><i class="fa fa-check"></i> Envoyer votre message !</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="col-md-3 col-sm-3">

                <h2>Consignes</h2>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus accusantium, aliquid asperiores aut corporis, cum eaque error est facilis id magnam maxime nam nostrum, quaerat quasi repellendus sint vel.
                </p>

            </div>

        </div>
    </section>
@endsection

@section('js')
    <script>
        app.submitForm('#form-telling', '#submit-telling');
    </script>
@endsection