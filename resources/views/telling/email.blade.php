@extends('layouts.app')

@section('title', 'Voyance par email')
@section('pageTitle', 'Contactez nos voyants par email')

@push('breadcrumbs')
<li class="active">Voyance par email</li>
@endpush

@section('content')

    <section>
        <div class="container">
            <div class="row">
            @foreach( $emails as $email )
                <div class="col-md-4 col-sm-4">

                    <div class="price-clean{{ $email->popular ? ' price-clean-popular' : '' }}">
                        @if( $email->popular )
                            <div class="ribbon">
                                <div class="ribbon-inner">POPULAIRE</div>
                            </div>
                        @endif
                        <h4>
                            <sup>€</sup>{{ $email->amount_price }}
                        </h4>
                        <h5> {{ $email->name }} </h5>
                        <hr />
                        <p>{{ $email->content }}</p>
                        <hr />
                        <a href="#" class="btn btn-3d btn-{{ $email->popular ? 'primary' : 'teal' }}">En savoir plus</a>
                    </div>

                </div>
            @endforeach
            </div>
        </div>
    </section>

@endsection