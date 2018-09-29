<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>N° GUÍA SALIDA</th>
        <th>FECHA</th>
        <th>STOCK INICIAL</th>
        <th>Nro. SACOS POR PROCESAR</th>
        <th>Nro. SACOS SALDO A PROCESAR</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($nuevaProducciones as $nuevaProduccion)
            @if($nuevaProduccion->estado)
            <tr>
                <td>{{$nuevaProduccion->nro_guia_salida}}</td>
                <td>{{$nuevaProduccion->fecha.' '.Carbon\Carbon::parse($nuevaProduccion->hora)->format('H:i:s A')}}</td>
                <td>{{$nuevaProduccion->nro_sacos_stock_inicial}}</td>
                <td>{{$nuevaProduccion->nro_sacos_a_procesar}}</td>
                <td>{{$nuevaProduccion->nro_sacos_saldo}}</td>
                <td>
                    @php
                        $idAnterior = $nuevaProduccion->ingresoProduccion->nuevaProduccion->where('estado','Habilitado')->last()->id
                    @endphp
                    <a href="#" class="btn btn-xs btn-default detalle" value="{{$nuevaProduccion->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                    <a href="{{route('nuevaproduccion.reporte',$nuevaProduccion->id)}}" target="_blank" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-print" ></span> IMP.</a>

                    @if(auth()->user()->area->descripcion == "administrador")
                    <a href="{{route('nuevaproduccion.edit',$nuevaProduccion->id)}}" class="btn btn-xs btn-warning edit
                    @if($nuevaProduccion->id != $idAnterior)
                            disabled
                    @endif
                    "  value="{{$nuevaProduccion->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                    {{csrf_field()}}

                    {{--<a href="{{route('recojo.index',['id'=>$nuevaProduccion->id])}}" class="btn btn-xs btn-success recojo"><span class="glyphicon glyphicon-plus" ></span> LISTA DE RECOJOS</a>--}}
                    <a href="#" class="btn btn-xs btn-danger delete
                    @if($nuevaProduccion->id != $idAnterior)
                            disabled
                    @endif
                        "  id="{{$nuevaProduccion->id}}"><span class="glyphicon glyphicon-remove" ></span> ELIM.</a>
                    @endif
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$nuevaProducciones->links()}}
</div>