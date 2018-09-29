<div class="col-lg-12 col-md-12 col-sm-12 table-responsive">
    <table class="table table-hover table-condensed small box">
        <thead>
        <th>CAMPAÑA</th>
        <th>FECHA - HORA</th>
        <th>N° GUÍA</th>
        <th>AGRI.\EMP.</th>
        <th>VARIEDAD</th>
        <th>N° SACOS RECEP.</th>
        <th>N° SACOS A SECAR</th>
        <th>N° SACOS OBTE.</th>
        <th>CONFORME</th>
        <th>ESTADO</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($loteSecados as $loteSecado)
            <tr>
                <td>{{$loteSecado->lote->compania}}</td>
                <td>{{$loteSecado->fecha}} {{Carbon\Carbon::parse($loteSecado->hora)->format('H:i A')}}</td>
                <td>{{$loteSecado->nro_serie_guia}}</td>
                @if($loteSecado->lote->agricultor)
                    <td>{{$loteSecado->lote->agricultor->apellidos}} {{$loteSecado->lote->agricultor->nombres}}</td>
                @elseif($loteSecado->lote->empresa)
                    <td>{{$loteSecado->lote->empresa->razon_social}}</td>
                @endif
                <td>{{$loteSecado->lote->variedad->descripcion}}</td>
                <td>{{$loteSecado->lote->nro_sacos}}</td>
                <td>{{$loteSecado->lote->nro_humedad_mayor_13}}</td>
                <td>
                    @if($loteSecado->estado_secado == 'terminado')
                        {{$loteSecado->sumtatotalnrosacosrecogidos()}}
                    @else
                        <span style="font-size: 10px;" class="label label-warning">{{ucwords("En proceso")}}</span>
                    @endif
                </td>
                <td>
                    @if(!$loteSecado->tendido->isEmpty())
                        @if($loteSecado->tendido->where('estado','Habilitado')->last()->ultimoNroSacosNoRecogidos() and $loteSecado->estado_secado == 'terminado')
                        <a href="#" class="btn btn-xs btn-primary @if($loteSecado->conforme)  @else conformidad @endif" loteSecado="{{$loteSecado->id}}" @if($loteSecado->conforme) disabled @endif>@if($loteSecado->conforme) SI @else NO @endif</a>
                        @else
                            <span style="font-size: 10px;" class="label label-warning">{{ucwords("En proceso")}}</span>
                        @endif
                    @else
                        <span style="font-size: 10px;" class="label label-warning">{{ucwords("En proceso")}}</span>
                    @endif
                </td>
                <td>
                    <span style="font-size: 10px;" class="@if($loteSecado->estado_secado == 'terminado') label label-success @else label label-warning @endif">{{ucwords($loteSecado->estado_secado)}}</span>
                </td>

                <td>
                    <a href="#" class="btn btn-xs btn-default detalle" value="{{$loteSecado->lote->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                    <a href="{{route('secado.reporte',['id'=>$loteSecado->id])}}" target="_blank" class="btn btn-xs btn-info
                        @if($loteSecado->estado_secado == 'terminado')
                        @else
                            disabled
                        @endif
                    "><span class="glyphicon glyphicon-print"></span> IMP.</a>
                    <a href="@if(!$loteSecado->accionesDisponibles()) # @else {{route('tendido.index',['id'=>$loteSecado->id])}}@endif" class="btn btn-xs btn-primary" @if(!$loteSecado->accionesDisponibles()) disabled @endif><span class="glyphicon glyphicon-list-alt"></span> TEND.</a>
                    {{--<a href="@if($loteSecado->estado_secado == 'terminado') # @elseif(!$loteSecado->accionesDisponibles()) # @elseif($loteSecado->lote->nro_humedad_mayor_13 <= $loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar')) # @else {{route('tendido.nuevo',['id'=>$loteSecado->id])}} @endif" @if($loteSecado->estado_secado == 'terminado') disabled @elseif(!$loteSecado->accionesDisponibles()) disabled @elseif($loteSecado->lote->nro_humedad_mayor_13 <= $loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar')) disabled @endif class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> TEND.</a>--}}
                    {{--<a href="@if($loteSecado->estado_secado == 'terminado') # @elseif(!$loteSecado->accionesDisponibles()) # @elseif($loteSecado->lote->nro_humedad_mayor_13 <= $loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar')) # @else {{route('tendido.nuevo',['id'=>$loteSecado->id])}} @endif" @if($loteSecado->estado_secado == 'terminado') disabled @elseif(!$loteSecado->accionesDisponibles()) disabled @elseif($loteSecado->lote->nro_humedad_mayor_13 <= $loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar')) disabled @endif class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> TENDIDO</a>--}}
                    {{--<a href="{{route('lote.reporte',$lote->id)}}" target="_blank" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> IMP.</a>--}}
                    {{--<a href="#" class="btn btn-xs btn-warning edit"  value="{{$lote->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>--}}
                    {{csrf_field()}}
                    {{--<a href="#" class="btn btn-xs btn-danger delete"  id="{{$lote->id}}"  @if($lote->conforme) disabled  @endif><span class="glyphicon glyphicon-remove"></span> ELIM.</a>--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$loteSecados->links()}}
</div>
