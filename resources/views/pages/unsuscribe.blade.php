@extends('layouts.app')

@section('title', 'Me désinscrire de la newsletter')

@push('breadcrumbs')
<li><a href="{{ url('login') }}">Désinscription de la newsletter</a></li>
@endpush

@section('content')
    <section class="height-300" id="slider" style="background:url({{ $cfg['cover_login'] }})">
        <div class="overlay dark-6"><!-- dark overlay [0 to 9 opacity] --></div>

        <div class="display-table">
            <div class="display-table-cell vertical-align-middle">

                <div class="container text-center">

                    <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                        Désinscription de la newsletter
                    </h1>

                </div>

            </div>
        </div>

    </section>
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <h2 class="size-16">Me désinscrire de la newsletter</h2>
                    <form role="form" class="form-vertical" method="POST" action="{{ route('newsletter.unsuscribe.post') }}" id="form-unsuscribe">
                        <div class="clearfix">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Adresse email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger" id="btn-unsuscribe">Me désinscrire</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        app.submitForm('#form-unsuscribe', '#btn-unsuscribe');
    </script>
@endsection
