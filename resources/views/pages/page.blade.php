@extends('layouts.app')

@section('title', $page->name)
@section('pageTitle', $page->name)

@push('breadcrumbs')
<li class="active">{{ $page->name }}</li>
@endpush

@section('content')

    <section>
        <div class="container">
            {!! $page->content !!}
        </div>
    </section>


@endsection