<div class="row">
    <div class="col-md-9">
        {!! BootForm::text('Titre de l\'horoscope', 'name') !!}
    </div>
    <div class="col-md-3">
        {!! BootForm::select('Signe astrologique', 'sign_id', $signs, $horoscope->sign_id) !!}
    </div>
</div>
{!! BootForm::textarea('Contenu de l\'horoscope', 'content', null)->id('summernote') !!}
<div class="row">
    <div class="col-md-6">
        {!! BootForm::date('Horoscope valable du', 'begin_at', is_null($horoscope->begin_at) ? null : $horoscope->begin_date) !!}
    </div>
    <div class="col-md-6">
        {!! BootForm::date('Jusqu\'au', 'ending_at', is_null($horoscope->ending_at) ? null : $horoscope->ending_date) !!}
    </div>
</div>
{!! BootForm::submit($title, 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}