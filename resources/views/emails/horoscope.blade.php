@component('mail::message')
# Votre horoscope de la part de Success Voyance !

Bonjour {{ $user->full_name }}, vous avez demandé à recevoir votre horoscope à chaque nouvelle publication.

## Horoscope du {{ $horoscope->begin }} au {{ $horoscope->ending }} pour le signe **{{ $sign->name }}**

@component('mail::image', ['name' => $sign->name, 'file' => $sign->logo])
@endcomponent

@component('mail::panel', ['url' => ''])
{!! $horoscope->content !!}
@endcomponent

@component('mail::button', ['url' => route('signs.horoscope', ['sign' => $sign->slug, 'slug' => $horoscope->slug])])
Consulter mon horoscope en ligne
@endcomponent

Pour changer vos préférences sur la réception de vos emails, rendez vous sur <a href="{{ route('account.edit') }}" alt="Mes préferences">cette page</a>.

Merci, <br />
{{ config('app.name') }}
@endcomponent