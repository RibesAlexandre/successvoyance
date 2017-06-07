@extends('layouts.app')

@section('title', 'Ma conversation voyance : ' . $emails[0]->topic)

@push('breadcrumbs')
<li><a href="{{ route('account') }}" alt="Mon compte">Mon compte</a></li>
<li><a href="{{ route('account.emails') }}" alt="Mes emails de voyance">Mes emails de voyance</a></li>
<li class="active">{{ str_limit($emails[0]->topic, 50) }}</li>
@endpush
@section('pageTitle', str_limit($emails[0]->topic, 100))

@section('content')
    <section>
        <div class="container">

            <div class="col-lg-3 col-md-3 col-sm-4">
                @include('auth.account.partials.menu')
            </div>

            <div class="col-lg-9 col-md-9 col-sm-8">
                @include('auth.account.partials.flipbox', ['icon' => 'fa-inbox', 'title' => $emails[0]->topic])

                <div class="box-light">
                    <div class="box-inner">
                        <ul class="comment list-unstyled" id="emails_conversations">
                        @foreach( $emails as $email )
                            @include('auth.account.partials.telling_email_body')

                            @if( $email->response )
                            <li class="comment comment-reply">

                                <img class="avatar" src="{{ asset('uploads/soothsayers/' . $email->response->soothsayer->picture) }}" width="50" height="50" alt="{{ $email->response->soothsayer->nickname }}" />
                                <div class="comment-body">
                                    <a href="{{ route('soothsayers.show', ['slug' => $email->response->soothsayer->slug]) }}" class="comment-author">
                                        <small class="text-muted pull-right">{{ $email->response->created_ago }}</small>
                                        <span>{{ $email->response->soothsayer->nickname }}</span>
                                    </a>
                                    <p>
                                        {!! nl2br($email->response->content) !!}
                                    </p>
                                </div>
                            </li>
                            @endif
                        @endforeach
                        </ul>
                    </div>
                </div>

                <form method="post" action="{{ route('account.email.post') }}" class="box-light margin-top-20" id="form-response">
                    {{ csrf_field() }}
                    <div class="box-inner">
                        <h4 class="uppercase">Répondre à la conversation</h4>
                        <input type="hidden" name="identifier" value="{{ $emails[0]->identifier }}">
                        <input type="hidden" name="topic" value="{{ $emails[0]->identifier }}">
                        <textarea required class="form-control word-count" data-maxlength="1000" rows="5" placeholder="Votre réponse" name="content" id="content"></textarea>
                        <div class="text-muted text-right margin-top-3 size-12 margin-bottom-10">
                            <span>0/1000</span> Mots
                        </div>

                        <button type="submit" class="btn btn-primary" id="send-response"><i class="fa fa-check"></i> Envoyer le message</button>
                    </div>
                </form>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        components.wordCounter();
        app.submitForm('#form-response', '#send-response');
    </script>
@endsection