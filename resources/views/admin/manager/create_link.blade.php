@extends('layouts.admin')

@section('title', 'Créer un nouveau lien')
@section('link', route('admin.manager.create_link'))
@section('navbar')
    <li>
        <a href="{{ route('admin.manager.index') }}">Management</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="header">
                <h4 class="title">Créer une nouveau lien</h4>
            </div>
            <div class="content">
                {!! BootForm::open()->action( route('admin.manager.store_link') )->id('link-form')->post() !!}
                {!! BootForm::bind($link) !!}
                @include('admin.manager.form_link', ['title' => 'Créer un nouveau lien'])
                {!! BootForm::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $('body').on('change', '#page', function(e) {
        	if( $(this).val() != 0 && $(this).val() != '0' ) {
        		$('#link').val($(this).val());
        		$('#name').val($(this).find('option:selected').text());
            } else {
        		$('#link').val('{{ $link->link }}');
        		$('#name').val('{{ $link->name }}');
            }
        })
        app.submitForm('#link-form', '#btn-submit');
    </script>
@endsection