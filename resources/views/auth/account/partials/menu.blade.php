<div class="thumbnail text-center">
    <img src="{{ $user->avatar() }}" alt="{{ $user->full_name }}" />
    <h2 class="size-18 margin-top-10 margin-bottom-0">{{ Auth::user()->full_name }}</h2>
    <h3 class="size-11 margin-top-0 margin-bottom-10 text-muted">Inscrit {{ $user->created_ago }}</h3>

</div>

<ul class="side-nav list-group margin-bottom-60" id="sidebar-nav">
    @if( Auth::check() && Auth::id() == $user->id )
        <li class="list-group-item{{ active('account') }}"><a href="{{ route('account') }}"><i class="fa fa-eye"></i> Mon profil</a></li>
    @else
        <li class="list-group-item"><a href="{{ route('account') }}"><i class="fa fa-eye"></i> Son profil</a></li>
    @endif
    <li class="list-group-item"><a href="{{ route('users.comments', ['id' => $user->id]) }}"><i class="fa fa-comments-o"></i> Commentaires</a></li>
    @if( Auth::check() && Auth::id() == $user->id )
    <li class="list-group-item{{ active('account.emails') }}"><a href="{{ route('account.emails') }}"><i class="fa fa-paper-plane"></i> Emails Voyance</a></li>
    <li class="list-group-item{{ active('account.edit') }}"><a href="{{ route('account.edit') }}"><i class="fa fa-gears"></i> Paramètres</a></li>
    @endif
</ul>

<div class="box-light margin-bottom-30">
    <div class="row margin-bottom-20">
        <div class="col-md-4 col-sm-4 col-xs-4 text-center bold">
            <h2 class="size-30 margin-top-10 margin-bottom-0 font-raleway">{{ $user->commentsCount }}</h2>
            <h3 class="size-11 margin-top-0 margin-bottom-10 text-info">commentaires</h3>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 text-center bold">
            <h2 class="size-30 margin-top-10 margin-bottom-0 font-raleway">{{ $user->topicsCount }}</h2>
            <h3 class="size-11 margin-top-0 margin-bottom-10 text-info">sujets</h3>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 text-center bold">
            <h2 class="size-30 margin-top-10 margin-bottom-0 font-raleway">{{ $user->messagesCount }}</h2>
            <h3 class="size-11 margin-top-0 margin-bottom-10 text-info">messages</h3>
        </div>
    </div>
    <!-- /info -->

    <div class="text-muted">
        <h2 class="size-18 text-muted margin-bottom-6"><b>A propos</b> de {{ $user->full_name }}</h2>

        <ul class="list-unstyled nomargin">
            @if( !is_null($user->job) )
                <li class="margin-bottom-10"><i class="fa fa-briefcase"></i> {{ $user->job }}</li>
            @endif
            @if( !is_null($user->age) && $user->can_age )
                <li class="margin-bottom-10"><i class="fa fa-birthday-cake"></i> {{ $user->age }} ans</li>
            @endif
            @if( !is_null($user->country) )
                <li class="margin-bottom-10"><i class="fa fa-map-marker"></i> {{ $user->country }}</li>
            @endif
            @if( !is_null($user->city) )
                <li class="margin-bottom-10"><i class="fa fa-map-signs"></i> {{ $user->city }}</li>
            @endif
            @if( !is_null($user->website) )
                <li class="margin-bottom-10"><i class="fa fa-globe width-20 hidden-xs hidden-sm"></i> <a href="{{ $user->website }}" alt="Site Web de {{ $user->full_name }}" target="_blank">{{ $user->website }}</a></li>
            @endif
        </ul>
    </div>
</div>