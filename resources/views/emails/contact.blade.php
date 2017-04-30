@component('mail::message')
# Nouveau message sur Success Voyance !

{{ $name }} vous a laissé le message suivant :

## {{ $topic }}

@component('mail::panel', ['url' => ''])
{{ $content }}
@endcomponent

Vous pouvez lui répondre en cliquant sur le bouton "Répondre" de votre boite email, ou avec l'adresse suivante : {{ $email }}

Merci, <br />
{{ config('app.name') }}
@endcomponent