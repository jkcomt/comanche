<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>N°.GUÍA</th>
        <th>FECHA-HORA</th>
        <th>PERSONA/EMPRESA</th>
        <th>COMPROBANTE</th>
        <th>N°.COMPROBANTE</th>
        <th>OPCIONES</th>
        </thead>
        <tbody>
        @foreach($ventas as $venta)
            @if($venta->estado == 'Habilitado')
                <tr>
                    <td>{{$venta->nro_guia_venta}}</td>
                    <td>{{$venta->fecha_venta}} {{ Carbon\Carbon::parse($venta->hora_venta)->format('H:i:s A') }}</td>
                    <td>
                        @if($venta->comprador_persona_id)
                            {{$venta->compradorPersona->apellidos.' '.$venta->compradorPersona->nombres}}
                        @elseif($venta->comprador_empresa_id)
                            {{$venta->compradorEmpresa->razon_social}}
                        @endif
                    </td>
                    <td>{{$venta->tipo_comprobante}}</td>
                    <td>
                        @switch($venta->tipo_comprobante)
                            @case('BOLETA')
                                {{$venta->nro_boleta}}
                                @break
                            @case('FACTURA')
                                {{$venta->nro_factura}}
                                @break
                            @case('TICKET')
                                {{$venta->nro_ticket}}
                            @break
                        @endswitch
                    </td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default detalle" value="{{$venta->id}}" id="{{$venta->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                        <a href="{{route('ventas.reporte',$venta->id)}}" target="_blank" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-print"></span> IMP.</a>
                        <a href="{{route('ventas.edit',$venta->id)}}" class="btn btn-xs btn-warning edit"  value="{{$venta->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                        {{csrf_field()}}
                        @if(auth()->user()->area->descripcion == 'administrador')
                            <button href="#" class="btn btn-xs btn-danger delete"  id="{{$venta->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</button>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$ventas->links()}}
</div>