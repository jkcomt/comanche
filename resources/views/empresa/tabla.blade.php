<div class="col-lg-12 col-md-12 col-sm-12" >
    <table class="table table-hover table-condensed box ">
        <thead>
        <th>RAZON SOCIAL</th>
        <th>RUC</th>
        <th>DIRECCIÓN</th>
        <th>TELÉFONO</th>
        <th>EMAIL</th>
        <th>REPRESENTANTE</th>
        <th>DNI</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($empresas as $empresa)
            @if($empresa->estado == 'Habilitado')
            <tr>
                <td>{{$empresa->razon_social}}</td>
                <td>{{$empresa->ruc}}</td>
                <td>{{substr($empresa->direccion,0,30)}}...</td>
                <td>{{$empresa->telefono}}</td>
                <td>{{$empresa->email}}</td>
                <td>{{$empresa->representante}}</td>
                <td>{{$empresa->dni_representante}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <button class="btn btn-xs btn-warning edit"  value="{{$empresa->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</button>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                        <button href="#" class="btn btn-xs btn-danger delete"  id="{{$empresa->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</button>
                    @endif
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$empresas->links()}}
</div>