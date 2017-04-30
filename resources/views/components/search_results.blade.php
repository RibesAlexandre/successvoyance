@if( (count($soothsayers) > 0 || count($pages) > 0 || count($astrologicalSigns) > 0) && $searched )
    <div class="heading-title heading-dotted text-center">
        <h2>Résultats de votre <span>recherche</span></h2>
    </div>
@elseif( $searched )
    <div class="alert alert-primary text-center">Votre recherche n'a retourné aucun résultat. Veuillez réessayer.</div>
@endif

@if( count($soothsayers) > 0 )
    @foreach( $soothsayers as $s )
        <div class="clearfix search-result">
            <h4 class="margin-bottom-0"><a href="{{ route('soothsayers.show', ['slug' => $s->slug]) }}">{{ $s->nickname }}</a></h4>
            <img src="{{ asset('uploads/soothsayers/' . $s->picture) }}" alt="{{ $s->nickname }}" height="60" />
            <p class="text-justify">{!! nl2br(stripslashes($s->content)) !!}</p>
        </div>
    @endforeach
@endif

@if( count($pages) > 0 )
    @foreach( $pages as $p )
        <div class="clearfix search-result">
            <h4 class="margin-bottom-0"><a href="{{ route('pages.show', ['slug' => $p->slug]) }}">{{ $p->name }}</a></h4>
            <small class="text-muted"><i class="fa fa-times"></i> Mise à jour le {{ $p->updated }}</small>
            <p>{!! str_limit(nl2br($p->content), 200, '...') !!}</p>
        </div>
    @endforeach
@endif

@if( count($astrologicalSigns) > 0 )
    @foreach( $astrologicalSigns as $a )
        <div class="clearfix search-result">
            <h4 class="margin-bottom-0"><a href="{{ route('signs.show', ['slug' => $a->slug]) }}">{{ $a->name }}</a></h4>
            <small class="text-muted">Du {{ $a->sign_begin_date }} au {{ $a->sign_ending_date }}</small>
            <img src="{{ $a->logo }}" alt="{{ $a->name }}" height="60" />
        </div>
    @endforeach
@endif