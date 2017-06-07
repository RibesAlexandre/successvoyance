<li class="comment">
    <img class="avatar" src="{{ $user->avatar() }}" width="50" height="50" alt="avatar" />
    <div class="comment-body">
        <a href="{{ route('users.show', ['id' => $user->id]) }}" class="comment-author">
            <small class="text-muted pull-right">{{ $email->created_ago }}</small>
            <span>{{ $user->full_name }}</span>
        </a>
        <p>
            {!! nl2br($email->content) !!}
        </p>
    </div>
</li>