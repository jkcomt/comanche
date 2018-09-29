<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>N° GUÍA</th>
        <th>FECHA</th>
        <th>RESPONSABLE</th>
        <th>Nro. SACOS TENDIDOS</th>
        <th>Nro. SACOS NO SECADOS</th>
        <th>Nro. SACOS PERDIDOS</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($tendidos as $tendido)
            <tr>
                <td>{{$tendido->nro_guia_tendido}}</td>
                <td>{{$tendido->fecha.' '.Carbon\Carbon::parse($tendido->hora)->format('H:i:s A')}}</td>
                <td>{{$tendido->responsable->apellidos.' '.$tendido->responsable->nombres}}</td>
                <td>{{$tendido->nro_sacos_a_secar}}</td>
                <td>{{$tendido->nro_sacos_no_secado}}</td>
                <td>@if($tendido->recojo->last())@if($tendido->recojo->last()->nro_sacos_no_recogidos == 0){{$tendido->nro_sacos_a_secar - $tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos')}}@endif @else 0 @endif</td>
                <td>
                    <a href="#" class="btn btn-xs btn-default detalle" value="{{$tendido->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                    <a href="{{route('tendido.reporte',$tendido->id)}}" target="_blank" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-print" ></span> IMP.</a>
                    {{--<a href="#" class="btn btn-xs btn-warning edit"  value="{{$lote->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>--}}
                    {{csrf_field()}}
                    <a href="{{route('recojo.index',['id'=>$tendido->id])}}" class="btn btn-xs btn-success recojo"><span class="glyphicon glyphicon-plus" ></span> LISTA DE RECOJOS</a>
                    <a href="#" class="btn btn-xs btn-danger @if($tendido->loteSecado->ultimoTendido()->id > $tendido->id) # @elseif($tendido->ultimoNroSacosNoRecogidos()) # @else delete @endif"  id="{{$tendido->id}}" @if($tendido->loteSecado->ultimoTendido()->id > $tendido->id) disabled @elseif($tendido->ultimoNroSacosNoRecogidos()) disabled @endif><span class="glyphicon glyphicon-remove" ></span> ELIM.</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$tendidos->links()}}
</div>