{!! BootForm::text('Titre du carousel', 'title') !!}
{!! BootForm::text('Lien du carousel', 'link') !!}
{!! BootForm::textarea('Contenu du carousel', 'content') !!}
{!! BootForm::file('Image du carousel', 'picture') !!}
{!! BootForm::date('Date de début du carousel', 'begin_at') !!}
{!! BootForm::date('Date de fin du carousel', 'ending_at') !!}
{!! BootForm::submit($title, 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}