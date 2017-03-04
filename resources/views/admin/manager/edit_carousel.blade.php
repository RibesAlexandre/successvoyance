@extends('layouts.admin')

@section('title', 'Mettre à jour le carousel')
@section('link', route('admin.manager.edit_carousel', ['id' => $carousel->id]))
@section('navbar')
    <li>
        <a href="{{ route('admin.manager.index') }}">Management</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Mettre à jour le carousel "{{ $carousel->name }}"</h4>
            </div>
            <div class="content">
                {!! BootForm::open()->action( route('admin.manager.update_carousel', ['id' => $carousel->id]) )->files(true)->id('carousel-form')->patch() !!}
                {!! BootForm::bind($carousel) !!}
                @include('admin.manager.form_carousel', ['title' => 'Mettre à jour le carousel'])
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
		app.submitForm('#carousel-form', '#btn-submit');
    </script>
@endsection