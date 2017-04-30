@extends('layouts.app')

@section('title', 'Signes astrologiques')
@section('pageTitle', 'Signes Astrologiques')

@push('breadcrumbs')
    <li class="active">Signes astrologiques</li>
@endpush

@section('content')
    <section class="callout-dark heading-title heading-arrow-bottom">
        <div class="container">
            <div class="text-center">
                <h3 class="size-30">Venez découvrir ce que les astres vous réservent !</h3>
            </div>
        </div>
    </section>
    @include('telling.signs_box')

@endsection