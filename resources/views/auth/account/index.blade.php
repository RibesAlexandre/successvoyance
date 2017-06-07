@extends('layouts.app')

@section('title', Auth::check() && Auth::id() == $user->id ? 'Mon compte' : 'Profil public de ' . $user->full_name)

@push('breadcrumbs')
    @if( Auth::check() && Auth::id() == $user->id )
        <li>Mon compte</li>
    @else
        <li>Profil de {{ $user->full_name }}</li>
    @endif
@endpush
@section('pageTitle', Auth::check() && Auth::id() == $user->id ? 'Mon compte' : 'Profil public de ' . $user->full_name)

@section('content')
    <section>
        <div class="container">

            <div class="col-lg-3 col-md-3 col-sm-4">
                @include('auth.account.partials.menu')
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8">
                @include('auth.account.partials.flipbox', ['icon' => 'fa-user', 'title' => $user->full_name])

                <div class="box-light">
                    <div class="row margin-top-30">
                        <div class="col-md-6 col-sm-6">

                            <div class="box-inner">
                                <h3>
                                    <a class="pull-right size-11 text-warning" href="{{ route('users.comments', ['id' => $user->id]) }}">Voir Tout</a>
                                    Derniers Commentaires
                                </h3>
                                <div class="height-250 slimscroll" data-always-visible="true" data-size="5px" data-position="right" data-opacity="0.4" disable-body-scroll="true">

                                    @forelse( $user->comments as $comment )
                                        <div class="clearfix margin-bottom-20">
                                            <img class="thumbnail pull-left" src="{{ $comment->user->avatar() }}" width="60" height="60" alt="{{ $comment->user->full_name }}" />
                                            <h4 class="size-15 nomargin noborder nopadding bold"><a href="#">{{ $comment->user->full_name }}</a></h4>
                                            <span class="size-13 text-muted">
                                            {!! str_limit(nl2br($comment->content, 100)) !!}
                                                <span class="text-success size-11">{{ $comment->created_ago }}</span>
                                        </span>
                                        </div>
                                    @empty
                                    <p class="text-center text-danger">{{ $user->full_name }} n'a laissé aucun commentaire.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">

                            <div class="box-inner">
                                <h3>
                                    <a class="pull-right size-11 text-warning" href="{{ route('users.topics', ['id' => $user->id]) }}">Voir Tout</a>
                                    Dernières conversations
                                </h3>
                                <div class="height-250 slimscroll" data-always-visible="true" data-size="5px" data-position="right" data-opacity="0.4" disable-body-scroll="true">

                                    @forelse( $user->topics as $topic )
                                        <div class="clearfix margin-bottom-20">
                                            <div class="clearfix margin-bottom-10">
                                                <img class="thumbnail pull-left" src="{{ $topic->user->avatar() }}" width="60" height="60" alt="{{ $topic->user->full_name }}" />
                                                <h4 class="size-13 nomargin noborder nopadding"><a href="blog-single-default.html">{{ str_limit($topic->title, 50) }}</a></h4>
                                                <span class="size-11 text-muted">{{ Date::parse($topic->created_at)->diffForHumans() }}</span>
                                            </div><!-- /post item -->
                                        </div>
                                    @empty
                                    <p class="text-center text-danger">{{ $user->full_name }} n'a posté aucune conversation sur le forum.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top-30">
                        <div class="col-md-12 col-sm-12">
                            <div class="box-inner">
                                <h3>
                                    <a class="pull-right size-11 text-warning" href="{{ route('users.posts', ['id' => $user->id]) }}">Voir Tout</a>
                                    Derniers messages
                                </h3>
                                <div class="height-250 slimscroll" data-always-visible="true" data-size="5px" data-position="right" data-opacity="0.4" disable-body-scroll="true">

                                    @forelse( $user->posts as $post )
                                        <div class="clearfix margin-bottom-20">
                                            <img class="thumbnail pull-left" src="{{ $post->user->avatar() }}" width="60" height="60" alt="{{ $post->user->full_name }}" />
                                            <h4 class="size-15 nomargin noborder nopadding bold"><a href="#">{{ $post->user->full_name }}</a></h4>
                                            <span class="size-13 text-muted">
                                            {!! str_limit(nl2br($post->body, 200)) !!}
                                            <span class="text-success size-11">{{ Date::parse($post->created_at)->diffForHumans() }}</span> <span class="size-11">dans <a href="#">{{ $post->discussion->title }}</a></span>
                                        </span>
                                        </div>
                                    @empty
                                    <p class="text-center text-danger">{{ $user->full_name }} n'a laissé aucun message sur le forum.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if( $user->can_contact && Auth::check() && Auth::user()->id != $user->id )
                <form method="post" action="#" class="box-light margin-top-20"><!-- .box-light OR .box-dark -->
                    <div class="box-inner">
                        <h4 class="uppercase">Laissez un message à <strong>{{ $user->full_name }}</strong></h4>

                        <textarea required name="message" class="form-control word-count" data-maxlength="100" rows="5" placeholder="Votre message"></textarea>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Envoyer votre message</button>
                    </div>
                </form>
                @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{ asset('js/plugins/jquery.slimscroll.min.js') }}"></script>
    <script>
        components.slimScroll();
    </script>
@endsection