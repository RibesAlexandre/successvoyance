@component('mail::message')
# Nouvel email de voyance !

{{ $user->full_name }} vous a envoyé un nouvel email de voyance :

### {{ $topic }}

@component('mail::panel', ['url' => ''])
{!! nl2br($content) !!}
@endcomponent

Pour lui répondre, rendez vous dans la zone administrative prévue à cet effet ou cliquez sur le bouton en dessous :

@component('mail::button', ['url' => route('admin.emails.conversation', ['identifier' => $identifier])])
    Répondre à {{ $user->full_name }}
@endcomponent

Merci, <br />
{{ config('app.name') }}
@endcomponent