<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <span class="glyphicon glyphicon-bell"></span>
    <span class="hidden-xs">Notificaciones</span>
    @if(count(auth()->user()->unreadNotifications) > 0)
        <span class="badge">{{count(auth()->user()->unreadNotifications)}}</span>
        <span class="caret"></span>
    @endif
</a>

<ul class="dropdown-menu" role="menu">
    @if(count(auth()->user()->unreadNotifications) > 0)

        @foreach(auth()->user()->unreadNotifications as $notification)
            @if(auth()->user()->area->descripcion == "secado" )
            <a href="{{route('secado.markasread',['id'=>$notification->id])}}" class="btn btn-flat btn-success btn-block ">Nuevo lote enviado : {{$notification->data['lote']}}</a>
            @endif
            @if(auth()->user()->area->descripcion == "produccion" )
            <a href="{{route('produccion.markasread',['id'=>$notification->id])}}" class="btn btn-flat btn-success btn-block ">Nuevo lote enviado : {{$notification->data['produccionIngreso']}}</a>
            @endif
        @endforeach
    @else
        <span class="btn btn-flat btn-block btn-primary">No hay notificaciones</span>
    @endif
</ul>

