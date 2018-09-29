<div class="col-lg-12 col-md-12 col-sm-12" >
    <table class="table table-hover table-condensed box ">
        <thead>
        <th>APE. Y NOMBRES</th>
        <th>DNI</th>
        <th>RUC</th>
        <th>CELULAR</th>
        <th>DIRECCIÓN</th>
        <th>EMAIL</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($compradorPersonas as $compradorPersona)
            @if($compradorPersona->estado == 'Habilitado')
            <tr>
                <td>{{$compradorPersona->apellidos.' '.$compradorPersona->nombres}}</td>
                <td>{{$compradorPersona->dni}}</td>
                <td>{{$compradorPersona->ruc}}</td>
                <td>{{$compradorPersona->celular}}</td>
                <td>{{$compradorPersona->direccion}}</td>
                <td>{{$compradorPersona->email}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <button class="btn btn-xs btn-warning edit"  value="{{$compradorPersona->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</button>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <button href="#" class="btn btn-xs btn-danger delete"  id="{{$compradorPersona->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</button>
                    @endif
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$compradorPersonas->links()}}
</div>