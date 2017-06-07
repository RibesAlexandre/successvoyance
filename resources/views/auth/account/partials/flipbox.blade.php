<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center nomargin">
    <div class="front">
        <div class="box1 noradius">
            <div class="box-icon-title">
                <i class="fa {{ $icon }}"></i>
                <h2>{{ $title }}</h2>
            </div>
            <p>Passez votre curseur par dessus ce block pour découvrir {{ Auth::check() && Auth::user()->id == $user->id ? 'votre' : 'sa' }} présentation.</p>
        </div>
    </div>

    <div class="back">
        <div class="box2 noradius">
            <h4>Qui est {{ $user->full_name }} ?</h4>
            <hr />
            @if( !is_null($user->biography) )
                <p>{!! $user->biography !!}</p>
            @else
                @if( Auth::check() && Auth::id() == $user->id )
                    <p>Vous n'avez pas rédigé votre block de présentation, <a href="#" class="bold text-white">cliquez ici</a> pour rédiger une petite présentation.</p>
                @else
                    {{ $user->full_name }} n'a pas encore rédigé sa présentation.
                @endif
            @endif
        </div>
    </div>
</div>