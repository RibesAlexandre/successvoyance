<div id="comment_{{ $comment->id }}">
    @if( $comment->isEditable() )
        <p class="pull-right">
            <a href="{{ route('comments.edit', ['id' => $comment->id]) }}" class="btn btn-sm btn-info edit-comment"><i class="fa fa-pencil"></i> Modifier</a>
            <a href="{{ route('comments.destroy', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger" data-action="delete" data-id="comment_{{ $comment->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i> Supprimer</a>
        </p>
    @endif
    <div class="block margin-bottom-30">
    <span class="user-avatar">
        <img class="pull-left media-object" src="{{ $comment->user->avatar() }}" width="64" height="64" alt="">
    </span>
        <div class="media-body">
            <h4 class="media-heading size-14">
                {{ $comment->user->full_name }} &ndash;
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
        </div>
    </div>
    <hr />
</div>