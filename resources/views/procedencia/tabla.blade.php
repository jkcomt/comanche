<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>LUGAR</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($procedencias as $procedencia)
            <tr>
                <td>{{$procedencia->lugar}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$procedencia->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$procedencia->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$procedencias->links()}}
</div>