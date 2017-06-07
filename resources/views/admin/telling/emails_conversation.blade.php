@extends('layouts.admin')

@section('title', 'Emails Voyance')
@section('link', route('admin.emails.conversation', ['identifier' =>    $emails[0]->identifier]))
@section('navbar')
    <li>
        <a href="{{ route('admin.emails.conversation', ['identifier' =>    $emails[0]->identifier]) }}">{{ $emails[0]->topic }}</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ $emails[0]->topic }}</h4>
            </div>
            <div class="content">
                @foreach( $emails as $email )
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ route('users.show', ['id' => $email->user->id]) }}">
                                <img class="media-object width-50 img-circle" src="{{ $email->user->avatar() }}" alt="{{ $email->user->full_name }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="pull-right"><a href="#" class="btn btn-info btn-fill btn-sm" data-id="{{ $email->id }}" data-action="response"><i class="fa fa-pencil"></i> Répondre</a></p>
                            <h4 class="media-heading">
                                {{ $email->user->full_name }}
                            </h4>
                            <p>{!! nl2br($email->content) !!}</p>

                            @if( $email->response )
                                <div class="media">
                                    <div class="media-left">
                                        <a href="{{ route('soothsayers.show', ['slug' => $email->response->soothsayer->slug]) }}">
                                            <img class="media-object width-50 img-circle" src="{{ asset('uploads/soothsayers/' . $email->response->soothsayer->picture) }}" alt="{{ $email->response->soothsayer->nickname }}">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $email->response->soothsayer->nicknamename }}</h4>
                                        <p>{!! nl2br($email->response->content) !!}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="card" id="form">
            <div class="header">
                <h4 class="title">Laissez une réponse à l'utilisateur</h4>
            </div>
            <div class="content">
                @if( !is_null(Auth::user()->soothsayer_id) )
                {!! BootForm::open()->action( route('admin.emails.response', ['identifier' => $emails[0]->identifier]) )->id('response-form')->post() !!}
                {!! Form::hidden('identifier', $emails[0]->identifier) !!}
                {!! Form::hidden('email_send_id', $last->id, ['id' => 'email_send_id']) !!}
                {!! BootForm::textarea('Votre réponse', 'content')->placeholder('Contenu de votre réponse...') !!}
                {!! BootForm::submit('Laisser une réponse', 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}
                {!! BootForm::close() !!}
                @else
                <div class="alert alert-danger text-center">Vous devez être associé à un profil voyant pour laisser une réponse. Cliquez <a class="bold" href="{{ route('admin.users.show', ['id' => Auth::user()->id]) }}">ici</a> pour associer votre profil à un voyant ou contactez un administrateur.</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        app.submitForm('#response-form', '#btn-submit');
        $('body').on('click', '[data-action="response"]', function(e) {
        	e.preventDefault();
        	$('#email_send_id').val($(this).attr('data-id'));
			$('html, body').animate({ scrollTop:  $('#form').offset().top - 50 }, 'slow');
        })
    </script>
@endsection