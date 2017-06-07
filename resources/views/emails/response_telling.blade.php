@component('mail::message')
# Réponse à votre email !

Bonjour {{ $email->user->full_name }}, {{ $response->soothsayer->nickname }} vient de répondre à votre email de voyance "{{ $email->topic }}" :

@component('mail::panel', ['url' => ''])
{!! nl2br($response->content) !!}
@endcomponent

Vous pouvez retrouver l'intégralité de la conversation en vous rendant dans votre espace membre ou en cliquant ci dessous :

@component('mail::button', ['url' => route('account.email', ['identifier' => $response->identifier])])
Voir toute la conversation
@endcomponent

Merci, <br />
{{ config('app.name') }}
@endcomponent