@extends('layouts.app')

@section('title', 'Signes astrologiques')

@push('breadcrumbs')
    <li>Signes astrologiques</li>
@endpush

@section('content')
    <section class="height-300" id="slider" style="background:url({{ $cfg['cover_signs'] }})">
        <div class="overlay dark-6"></div>

        <div class="display-table">
            <div class="display-table-cell vertical-align-middle">

                <div class="container text-center">

                    <h1 class="nomargin wow fadeInUp" data-wow-delay="0.4s">
                        Signes Astrologiques
                    </h1>
                </div>

            </div>
        </div>

    </section>
    <section>
        <div class="container">
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc vehicula lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet.</p>

            <div class="divider divider-center divider-color">
                <i class="fa fa-chevron-down"></i>
            </div>

            <div class="row">
                @foreach( $signs as $sign )
                    <div class="col-md-4 col-xs-6">
                        <div class="text-center">
                            <i class="ico-color ico-lg ico-rounded ico-hover">
                            <img src="{{ $sign->logo }}" alt="{{ $sign->name }}" class="img-responsive width-30 ">
                            </i>
                            <h4>{{ $sign->name }}</h4>
                            @if( $sign->content )
                                <p class="font-lato size-15">{{ str_limit(strip_tags($sign->content), 100, '...') }}</p>
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
    </section>

@endsection