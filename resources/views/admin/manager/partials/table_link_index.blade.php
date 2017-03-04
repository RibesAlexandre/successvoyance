<tr id="link_{{ $link->id }}">
    <td class="text-center">{{ $link->id }}</td>
    @if( !is_null($link->parent_id) )
    <td class="text-center">{{ $link->name }}</td>
    @else
    <td class="text-center"><a href="{{ route('admin.manager.link', ['id' => $link->id]) }}">{{ $link->name }}</a></td>
    @endif
    <td class="text-center"><a href="{{ $link->link }}" target="_blank">{{ isInRoute('admin.manager.link') ? $link->link : str_limit($link->link, 20) }}</a></td>
    <td class="text-center" data-info="position">{{ $link->position }}</td>
    @if( !isInRoute('admin.manager.link') )
    <td class="text-center">{{ $containers[$link->container] }}</td>
    @endif
    @if( isInRoute('admin.manager.link') )
    <td class="text-center">{{ !is_null($link->parent_id) ? $link->parent->name : 'Aucun' }}</td>
    @endif
    <td class="text-center">
        <a href="{{ route('admin.manager.order', ['id' => $link->id, 'asc' => 'up', 'type' => 'link']) }}" class="btn btn-xs btn-fill btn-default" data-action="order" data-asc="up" data-div="link"><i class="fa fa-caret-up"></i></a>
        <a href="{{ route('admin.manager.order', ['id' => $link->id, 'asc' => 'down', 'type' => 'link']) }}" class="btn btn-xs btn-fill btn-default" data-action="order" data-asc="down" data-div="link"><i class="fa fa-caret-down"></i></a>
        <a href="{{ route('admin.manager.edit_link', ['id' => $link->id]) }}" class="btn btn-xs btn-fill btn-info"><i class="fa fa-pencil"></i></a>
        <a href="{{ route('admin.manager.destroy_link', ['id' => $link->id]) }}" data-action="delete" data-id="link_{{ $link->id }}" data-token="{{ csrf_token() }}" data-message="Êtes vous sûr de vouloir supprimer ce lien ? Cette action est irréversible." class="btn btn-xs btn-fill btn-danger"><i class="fa fa-trash-o"></i></a>
    </td>
</tr>