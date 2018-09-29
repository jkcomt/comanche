<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>NICK</th>
        {{--<th>EMAIL</th>--}}
        <th>AREA</th>
        <th>APELLIDOS Y NOMBRES</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->name}}</td>
                {{--<td>{{$usuario->email}}</td>--}}
                <td>{{ucfirst($usuario->area->descripcion)}}</td>
                <td>{{$usuario->personal->apellidos.' '.$usuario->personal->nombres}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$usuario->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$usuario->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$usuarios->links()}}
</div>