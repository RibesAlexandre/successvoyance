@component('mail::message')
# Nouveau commentaire pour {{ $soothsayer->nickname }} !

{{ $user->full_name }} vous a laissé un nouveau commentaire sur votre fiche voyance :

@component('mail::panel', ['url' => ''])
{!! nl2br($comment->content) !!}
@endcomponent

Il a vous a noté avec {{ $comment->stars }} étoiles.

@component('mail::button', ['url' => route('soothsayers.show', ['slug' => $soothsayer->slug])])
Je vais lui répondre !
@endcomponent


Merci, <br />
{{ config('app.name') }}
@endcomponent