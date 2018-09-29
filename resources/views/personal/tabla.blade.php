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
        @foreach($personales as $personal)
            <tr>
                <td>{{$personal->nombres.' '.$personal->apellidos}}</td>
                <td>{{$personal->dni}}</td>
                <td>{{$personal->celular}}</td>
                <td>{{$personal->direccion}}</td>
                <td>{{$personal->email}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$personal->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$personal->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$personales->links()}}
</div>