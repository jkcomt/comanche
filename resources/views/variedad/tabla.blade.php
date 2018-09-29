<div class="col-lg-12 col-md-12 col-sm-12 ">
    <table class="table table-hover table-condensed box">
        <thead>
        <th>DESCRIPCION</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($variedades as $variedad)
          @if($variedad->estado == "Habilitado")
            <tr>
                <td>{{$variedad->descripcion}}</td>
                <td>
                    {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                    <a href="#" class="btn btn-xs btn-warning edit"  value="{{$variedad->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}
                    @if(auth()->user()->area->descripcion == 'administrador')
                    <a href="#" class="btn btn-xs btn-danger delete"  id="{{$variedad->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                    @endif
                </td>
            </tr>
          @endif
        @endforeach
        </tbody>
    </table>
    {{$variedades->links()}}
</div>
