<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>NOMBRES Y APELLIDOS</th>
        <th>DNI</th>
        <th>CELULAR</th>
        <th>DIRECCIÓN</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($choferes as $chofer)
          @if($chofer->estado == "Habilitado")
            <tr>
                <td>{{$chofer->nombres.' '.$chofer->apellidos}}</td>
                <td>{{$chofer->dni}}</td>
                <td>{{$chofer->celular}}</td>
                <td>{{$chofer->direccion}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$chofer->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$chofer->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                    @endif
                </td>
            </tr>
          @endif
        @endforeach
        </tbody>
    </table>
    {{$choferes->links()}}
</div>
