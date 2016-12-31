{!! BootForm::text('Nom du rôle', 'name') !!}

@foreach( $sections->values()->all() as $section )
<h3 class="text-center">{{ trans('permissions.permission_' . $section) }}</h3>

<?php $perms = $permissions->where('section', $section); ?>

@foreach( $perms->all() as $perm )
    <div class="checkbox">
        <label>
            @if( is_object($role->permissions) && in_array($perm->id, $permissionsIds) )
                {!! Form::checkbox('permissions[]', $perm->id, ['checked' => true]) !!} <strong>{{ $perm->name }}</strong>
            @else
                {!! Form::checkbox('permissions[]', $perm->id) !!} <strong>{{ $perm->name }}</strong>
            @endif
        </label>
    </div>
@endforeach
<hr>
@endforeach