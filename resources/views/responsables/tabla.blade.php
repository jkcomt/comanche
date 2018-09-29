<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>APELLIDOS Y NOMBRES</th>
        <th>DNI</th>
        <th>CELULAR</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($responsables as $responsable)
            <tr>
                <td>{{$responsable->apellidos.' '.$responsable->nombres}}</td>
                <td>{{$responsable->dni}}</td>
                <td>{{$responsable->celular}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$responsable->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$responsable->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$responsables->links()}}
</div>