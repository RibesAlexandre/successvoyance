@extends('layouts.app')

@section('title', Auth::check() && Auth::id() == $user->id ? 'Mes sujets' : 'Conversations de ' . $user->full_name)

@push('breadcrumbs')
@if( Auth::check() && Auth::id() == $user->id )
    <li><a href="{{ route('account') }}" alt="Mon compte">Mon compte</a></li>
    <li class="active">Mes Conversations</li>
@else
    <li><a href="{{ route('users.index') }}" alt="Liste des utilisateurs">Utilisateurs</a></li>
    <li><a href="{{ route('users.show', ['slug' => $user->slug]) }}" alt="Profil de {{ $user->full_name }}">{{ $user->full_name }}</a></li>
    <li class="active">Ses Conversations</li>
@endif
@endpush
@section('pageTitle', Auth::check() && Auth::id() == $user->id ? 'Mes sujets' : 'Conversations de ' . $user->full_name)

@section('content')
    <section>
        <div class="container">

            <div class="col-lg-3 col-md-3 col-sm-4">
                @include('auth.account.partials.menu')
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8">
                @include('auth.account.partials.flipbox', ['icon' => 'fa-comment-o', 'title' => 'Conversations de ' . $user->full_name])

                <div class="box-light">
                    <div class="box-inner">
                        <ul class="comment list-unstyled">
                            @forelse( $topics as $topic )
                                <li class="comment">
                                    <img class="avatar" src="{{ $topic->user->avatar() }}" width="50" height="50" alt="{{ $topic->user->full_name }}" />
                                    <div class="comment-body">
                                        <a href="{{ route('users.show', ['id' => $topic->user->id]) }}" class="comment-author">
                                            <small class="text-muted pull-right"> {{ Date::parse($topic->created_at)->diffForHumans() }} </small>
                                            <span>{{ $topic->user->full_name }}</span>
                                        </a>
                                        <h4><a href="#">{{ $topic->title }}</a></h4>
                                    </div>

                                    {{--
                                    <ul class="list-inline size-11 margin-top-10">
                                        <li>
                                            <a href="#" class="text-info"><i class="fa fa-reply"></i> Reply</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-success"><i class="fa fa-thumbs-up"></i> Like</a>
                                        </li>
                                        <li>
                                            <a href="#" class="text-muted">Show All Comments (36)</a>
                                        </li>
                                        <li class="pull-right">
                                            <a href="#" class="text-danger">Delete</a>
                                        </li>
                                        <li class="pull-right">
                                            <a href="#" class="text-primary">Edit</a>
                                        </li>
                                    </ul>
                                    --}}
                                </li>
                            @empty
                                <li class="comment">
                                    <img class="avatar" src="{{ $user->avatar() }}" width="50" height="50" alt="{{ $user->full_name }}" />
                                    <div class="comment-body">
                                        <a href="{{ route('users.show', ['id' => $user->id]) }}" class="comment-author">
                                            <small class="text-muted pull-right"> {{ Date::now()->format('d F M Y') }} </small>
                                            <span>{{ $user->full_name }}</span>
                                        </a>
                                        <p>n'a crée aucune conversation sur le forum pour le moment.</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="text-center">
                        {!! $topics->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')

@endsection