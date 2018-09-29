<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>NOMBRES Y APELLIDOS</th>
        <th>DNI</th>
        <th>CELULAR</th>
        <th>DIRECCIÓN</th>
        <th>EMAIL</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->nombres.' '.$cliente->apellidos}}</td>
                <td>{{$cliente->dni}}</td>
                <td>{{$cliente->celular}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->email}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$cliente->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$cliente->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$clientes->links()}}
</div>