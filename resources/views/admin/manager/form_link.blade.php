<div class="row">
    <div class="col-md-4">
        {!! BootForm::text('Nom du lien', 'name') !!}
    </div>
    <div class="col-md-4">
        {!! BootForm::text('Lien où pointer', 'link') !!}
    </div>
    <div class="col-md-4">
        {!! BootForm::select('Où placer le lien', 'container', $containers) !!}
    </div>
</div>
@if( isInRoute('admin.manager.create_link') )
{!! BootForm::select('Liens de page', 'page', $pages) !!}
@endif
{!! BootForm::select('Parent du lien', 'parent_id', $parents) !!}
{!! BootForm::submit($title, 'btn btn-success btn-block btn-fill')->id('btn-submit') !!}