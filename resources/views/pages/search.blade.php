@extends('layouts.app')

@section('title', 'Effectuez librement une recherche sur le site')
@section('pageTitle', 'Recherche')

@push('breadcrumbs')
<li class="active">Recherche</li>
@endpush

@section('content')
    <section class="padding-top-20 padding-bottom-20 alternate">
        <div class="container">

            <form method="post" action="{{ route('search.post') }}" class="clearfix well well-sm search-big nomargin" id="form-search">
                {!! csrf_field() !!}
                <div class="input-group">
                    <input name="search" class="form-control input-lg" type="text" placeholder="Votre recherche...">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default input-lg noborder-left" id="submit-search">
                            <i class="fa fa-search fa-lg nopadding"></i>
                        </button>
                    </div>
                </div>

            </form>

            <h6 class="nomargin text-muted size-11">
                Parmi les pages du site, nos voyants et les signes astrologiques...
            </h6>

        </div>
    </section>

    <section class="padding-xs">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="search-results">
                    @include('components.search_results')
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        app.submitForm('#form-search', '#submit-search');
    </script>
@endsection