<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>N° GUÍA</th>
        <th>FECHA</th>
        <th>Nro SACOS RECOGIDOS</th>
        <th>KG RECOGIDOS</th>
        <th>PESO RECOGIDO</th>
        <th>Nro SACOS NO RECOGIDOS</th>
        <th>KG NO RECOGIDOS</th>
        <th>PESO NO RECOGIDO</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($recojos as $recojo)
            <tr>
                <td>{{$recojo->nro_guia_recojo}}</td>
                <td>{{$recojo->fecha.' '.Carbon\Carbon::parse($recojo->hora)->format('H:i:s A')}}</td>
                <td>{{$recojo->nro_sacos_recogidos}}</td>
                <td>{{$recojo->kilos_recogidos}}</td>
                <td>{{$recojo->peso_recogidos}}</td>
                <td>{{$recojo->nro_sacos_no_recogidos}}</td>
                <td>{{$recojo->kilos_no_recogidos}}</td>
                <td>{{$recojo->peso_no_recogido}}</td>
                <td>
                    <a href="#" class="btn btn-xs btn-default detalle" value="{{$recojo->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                    <a href="{{route('recojo.reporte',$recojo->id)}}" target="_blank" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-print" ></span> IMP.</a>
                    {{--<a href="#" class="btn btn-xs btn-warning edit"  value="{{$lote->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>--}}
                    {{csrf_field()}}
                    <a href="#" class="btn btn-xs btn-danger @if($recojo->ultimoRecojo()->id > $recojo->id) @else delete @endif"  id="{{$recojo->id}}" @if($recojo->ultimoRecojo()->id > $recojo->id) disabled @endif ><span class="glyphicon glyphicon-remove" ></span> ELIM.</a>
                </td>
            </tr>
        @endforeach
        @if(!empty($recojos))
            <tr>
                <td></td>
                <td><strong>Total :</strong></td>
                <td><strong>{{$recojos->sum('nro_sacos_recogidos')}}</strong></td>
                <td><strong>{{$recojos->sum('kilos_recogidos')}}</strong></td>
                <td><strong>{{($recojos->sum('peso_recogidos'))}}</strong></td>
            </tr>
        @endif
        </tbody>
    </table>
    {{$recojos->links()}}
</div>