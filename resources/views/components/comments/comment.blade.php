<div id="comment_{{ $comment->id }}">
    @if( $comment->isEditable() || (Auth::check() && Auth::user()->soothsayer_id == $soothsayer->id) )
        <p class="pull-right">
            @if( $comment->isEditable() )
            <a href="{{ route('comments.edit', ['id' => $comment->id]) }}" class="btn btn-sm btn-info edit-comment"><i class="fa fa-pencil"></i> Modifier</a>
            <a href="{{ route('comments.destroy', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger" data-action="delete" data-id="comment_{{ $comment->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i> Supprimer</a>
            @endif
            @if( Auth::check() && Auth::user()->soothsayer_id == $soothsayer->id )
            <a href="#response_{{ $comment->id }}" data-action="display-response" class="btn btn-sm btn-primary"><i class="fa fa-comment"></i> Répondre</a>
            @endif
        </p>
    @endif
    <div class="block margin-bottom-30">
    <span class="user-avatar">
        <img class="pull-left media-object img-circle img-thumbnail" src="{{ !is_null($comment->user->soothsayer_id) ? asset('uploads/soothsayers/' . $comment->user->soothsayer->picture) : $comment->user->avatar() }}" width="64" height="64" alt="">
    </span>
        <div class="media-body">
            <h4 class="media-heading size-14">
                {{ !is_null($comment->user->soothsayer_id) ? $comment->user->soothsayer->nickname : $comment->user->full_name }} &ndash;
                <span class="text-muted">{{ $comment->created_ago }}</span> &ndash;
                <span class="size-14 text-muted">
            @for( $i = 0; $i < 5; $i++ )
                        @if( $i < $comment->stars)
                            <i class="fa fa-star"></i>
                        @else
                            <i class="fa fa-star-o"></i>
                        @endif
                    @endfor
            </span>
            </h4>

            <p id="comment_content_{{ $comment->id }}">
                {!! nl2br(strip_tags($comment->content)) !!}
            </p>

            <div id="response_{{ $comment->id }}" style="display: none;">
                {!! BootForm::open()->action(route('comments.store'))->post()->id('form-response') !!}
                {!! Form::hidden('parent_id', $comment->id) !!}
                {!! Form::hidden('soothsayer_id', $soothsayer->id) !!}
                {!! BootForm::textarea('Votre réponse', 'content') !!}
                {!! BootForm::submit('Soumettre votre réponse')->id('submit-response')->class('btn btn-success') !!}
                {!! BootForm::close() !!}
            </div>

            <div id="responses_{{ $comment->id }}">
                @if( count($comment->responses) > 0 )
                    @foreach( $comment->responses as $response )
                        @include('components.comments.comment', ['comment' => $response])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @if( is_null($comment->parent_id) )
    <hr />
    @endif
</div>