<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>N° GUÍA ING.</th>
        <th>FECHA INGRESO</th>
        <th>N° GUÍA</th>
        <th>AGRICULTOR\EMPRESA</th>
        <th>ORIGEN</th>
        <th>ESTADO</th>
        <th>CONFORME</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($produccionIngresos as $produccionIngreso)
            @if($produccionIngreso->estado == 'Habilitado')
            <tr>
                <td>{{$produccionIngreso->nro_guia_ingreso}}</td>
                <td>{{$produccionIngreso->fecha}} {{ Carbon\Carbon::parse($produccionIngreso->hora)->format('H:i:s A') }}</td>
                <td>{{$produccionIngreso->lote->nro_guia}}</td>
                @if($produccionIngreso->lote->agricultor)
                    <td>{{$produccionIngreso->lote->agricultor->apellidos}} {{$produccionIngreso->lote->agricultor->nombres}}</td>
                @elseif($produccionIngreso->lote->empresa)
                    <td>{{$produccionIngreso->lote->empresa->razon_social}}</td>
                @endif
                <td>{{$produccionIngreso->area_origen}}</td>
                <td>
                    @if($produccionIngreso->estado_prod_ingreso == 'terminado')
                        <span style="font-size: 10px;" class="   label label-success ">{{ucwords($produccionIngreso->estado_prod_ingreso)}}</span>
                    @else
                        @if($produccionIngreso->nuevaProduccion->first())
                            <span style="font-size: 10px;" class="label label-warning">{{ucwords($produccionIngreso->estado_prod_ingreso)}}</span>
                        @else
                            <span style="font-size: 10px; background-color:yellow !important; color: #000 !important;" class="label label-warning">Aperturado</span>
                        @endif
                    @endif
                </td>
                <td>
                    @if($produccionIngreso->estado_prod_ingreso == 'terminado')
                        <a href="#" produccion="{{$produccionIngreso->id}}" class="btn btn-xs btn-primary
                          @if($produccionIngreso->conforme)
                            @else
                                conformidad
                          @endif" @if($produccionIngreso->conforme) disabled @endif
                        >@if($produccionIngreso->conforme) SI @else NO @endif</a>
                    @else
                        <span style="font-size: 10px;" class="label label-warning">{{ucwords("En proceso")}}</span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-xs btn-default detalle" value="{{$produccionIngreso->lote->id}}" id="{{$produccionIngreso->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                    <a href="{{route('produccion.reporte',$produccionIngreso->id)}}" target="_blank" class="btn btn-xs btn-info
                    @if($produccionIngreso->estado_prod_ingreso == 'terminado')
                    @else
                        disabled
                    @endif
                    "><span class="glyphicon glyphicon-print"></span> IMP.</a>
                    {{csrf_field()}}
                    <a href="{{route('nuevaproduccion.index',['id'=>$produccionIngreso->id])}}" class="btn btn-xs btn-success
                    @if(!$produccionIngreso->validarDetallesRegistrosAnteriores())
                        disabled
                    @endif
                    "><span class="glyphicon glyphicon-plus"></span> NUEVA PRODUCCION</a>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$produccionIngresos->links()}}
</div>
