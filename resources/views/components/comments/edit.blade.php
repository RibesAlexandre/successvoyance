{!! BootForm::openHorizontal(['sm' => [3,9], 'lg' => [2,10]])->action( route('comments.update', ['id' => $comment->id]) )->id('update-comment')->put() !!}
{!! BootForm::bind($comment) !!}
{!! BootForm::hidden('stars', $comment->stars) !!}
{!! BootForm::textarea('Commentaire', 'content', null) !!}
{!! BootForm::close() !!}