<section>
    <div class="container">
        <div id="portfolio" class="portfolio-gutter">
            <div class="row mix-grid text-center">

                @foreach( $signs as $sign)
                    <div class="col-md-3 col-sm-3 mix design text-center"><!-- item -->

                        <div class="item-box">
                            <a href="{{ route('signs.show', ['slug' => $sign->slug]) }}" alt="{{ $sign->name }}"><img src="{{ $sign->logo }}" alt="{{ $sign->name }}"></a>

                            <div class="item-box-desc">
                                <a href="{{ route('signs.show', ['slug' => $sign->slug]) }}" alt="{{ $sign->name }}"><h3>{{ $sign->name }}</h3></a>
                                <p class="small">Du {{ $sign->sign_begin_date }} au {{ $sign->sign_ending_date }}</p>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>