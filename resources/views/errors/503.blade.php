@extends('layouts.app')

@section('title', 'Site en maintenance')

@section('content')
    <section class="text-center">

        <h1 class="margin-bottom-20 size-30">{{ config('app.name') }} est en cours de maintenance</h1>
        <p class="size-20 font-lato">Nous sommes en train de mettre à jour le site, n'hésitez pas à revenir d'ici quelques minutes ;)</p>

        <!-- socials -->
        <a href="#" class="social-icon social-icon-sm social-facebook" title="Facebook">
            <i class="icon-facebook"></i>
            <i class="icon-facebook"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-twitter" title="Twitter">
            <i class="icon-twitter"></i>
            <i class="icon-twitter"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-gplus" title="Google plus">
            <i class="icon-gplus"></i>
            <i class="icon-gplus"></i>
        </a>

        <a href="#" class="social-icon social-icon-sm social-linkedin" title="Linkedin">
            <i class="icon-linkedin"></i>
            <i class="icon-linkedin"></i>
        </a>
        <!-- /socials -->
    </section>

@endsection