@extends('layouts.app')

@section('title', 'Découvrez tout(e)s nos voyant(e)s à votre écoute !')
@section('pageTitle', 'Découvrez nos voyant(e)s')

@push('breadcrumbs')
<li class="active">Voyant(e)s</li>
@endpush

@section('content')
    <section>
        <div class="container">
            <ul class="shop-item-list row list-inline nomargin">

            @foreach( $soothsayers as $s )
                <!-- ITEM -->
                    <li class="col-lg-3 col-sm-3">

                        <div class="shop-item">

                            <div class="thumbnail">
                                <!-- product image(s) -->
                                <a class="shop-item-image" href="{{ route('soothsayers.show', ['slug' => $s->slug]) }}">
                                    <img class="img-responsive" src="{{ asset('uploads/soothsayers/' . $s['picture']) }}" alt="{{ $s['nickname'] }}" alt="shop first image" />
                                </a>
                                <!-- /product image(s) -->
                            </div>

                            <div class="shop-item-summary text-center">
                                <h2>{{ $s->nickname }}</h2>

                                <!-- rating -->
                                <div class="shop-item-rating-line">
                                    <div class="rating rating-{{ $s->rating }} size-13"><!-- rating-0 ... rating-5 --></div>
                                </div>
                                <!-- /rating -->
                                <!-- /price -->
                            </div>

                            <!-- buttons -->
                            <div class="shop-item-buttons text-center">
                                <a class="btn btn-primary" href="{{ route('soothsayers.show', ['slug' => $s->slug]) }}"><i class="fa fa-eye"></i> Voir la fiche</a>
                            </div>
                            <!-- /buttons -->
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </section>

@endsection

@section('js')
    @parent
    <script>
		app.submitForm('#contact-form', '#submit-contact');
    </script>
@endsection