@if( $c['status_08'] )
    <div class="label label-success"><i class="fa fa-phone"></i> {{ $c['phone'] }}</div>
@elseif( $c['status_cb'] )
    <div class="label label-success"><i class="fa fa-phone"></i> {{ $c['phone'] }}</div>
@elseif( !$c['status_cb'] && !$c['status_08'] )
    <div class="label label-danger">Indisponible</div>
@else
    <div class="label label-success"><i class="fa fa-phone"></i> {{ $c['phone'] }}</div>
@endif