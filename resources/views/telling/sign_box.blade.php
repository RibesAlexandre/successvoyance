<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-9 text-center">
        <img class="img-responsive" src="{{ $sign->logo }}" alt="{{ $sign->name }}">
    </div>

    <div class="col-lg-9 col-md-9 col-sm-9">
        <h2 class="size-25">{{ $sign->name }} <small>Du {{ $sign->sign_begin_date }} au {{ $sign->sign_ending_date }}</small></h2>
        {!! $sign->content !!}
    </div>
</div>