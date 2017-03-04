{!! BootForm::text('Nom du signe', 'name', null) !!}
{!! BootForm::textarea('Description du signe', 'content', null)->id('summernote') !!}
{!! BootForm::date('Date de début du signe', 'begin_at') !!}
{!! BootForm::date('Date de fin du signe', 'ending_at') !!}
{!! BootForm::file('Logo du signe', 'logo') !!}
{!! BootForm::submit($title, 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}