<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>MARCA</th>
        <th>DESCRIPCIÓN</th>
        <th>PLACA</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($vehiculos as $vehiculo)
            <tr>
                <td>{{$vehiculo->marca}}</td>
                <td>{{$vehiculo->descripcion}}</td>
                <td>{{$vehiculo->placa}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$vehiculo->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$vehiculo->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$vehiculos->links()}}
</div>