@extends('layouts.app')

@section('title', 'Contactez nous')
@section('pageTitle', 'Laissez nous un message !')

@push('breadcrumbs')
<li class="active">Contact</li>
@endpush

@section('content')
    <section class="height-400" id="slider" style="background:url({{ asset('imgs/design/covers/phone.jpg') }})">
        <div class="overlay dark-6"></div>

        <div class="display-table">
            <div class="display-table-cell vertical-align-middle">

                <div class="container text-center">

                    <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                        Contactez nous
                    </h1>
                </div>

            </div>
        </div>

    </section>
    <section>
        <div class="container">
            {!! BootForm::openHorizontal(['sm' => [3,9], 'lg' => [2,10]])->action( route('contact.post') )->id('contact-form')->post() !!}
            @if( Auth::check() )
                {!! BootForm::bind(Auth::user()) !!}
            @endif
            {!! BootForm::text('Nom', 'name', null) !!}
            {!! BootForm::text('Prénom', 'firstname', null) !!}
            {!! BootForm::email('Adresse email', 'email', null) !!}
            {!! BootForm::text('Sujet', 'topic', null) !!}
            {!! BootForm::textarea('Votre message', 'content', null) !!}
            {!! BootForm::submit('Envoyer le message', 'btn btn-success btn-block')->id('submit-contact') !!}
            {!! BootForm::close() !!}
        </div>
    </section>

@endsection

@section('js')
    @parent
    <script>
        app.submitForm('#contact-form', '#submit-contact');
    </script>
@endsection