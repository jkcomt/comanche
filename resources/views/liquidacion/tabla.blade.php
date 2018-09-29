<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>N°.GUÍA</th>
        <th>FECHA-HORA</th>
        <th>PERSONA/EMPRESA</th>
        <th>ESTADO</th>
        <th>OPCIONES</th>
        </thead>
        <tbody>
        @foreach($liquidaciones as $liquidacion)
            @if($liquidacion->estado == 'Habilitado')
                <tr>
                    <td>{{$liquidacion->serie_liquidacion}}</td>
                    <td>{{$liquidacion->fecha_registro}}</td>
                    <td>
                        @if($liquidacion->lote->agricultor_id)
                            {{$liquidacion->lote->agricultor->apellidos.' '.$liquidacion->lote->agricultor->nombres}}
                        @elseif($liquidacion->lote->empresa_id)
                            {{$liquidacion->lote->empresa->razon_social}}
                        @endif
                    </td>
                    <td>
                        @if($liquidacion->lote->produccionIngresoNoConforme() && $liquidacion->lote->loteSecadoNoConforme())
                            @if($liquidacion->lote->stockResultadoProduccionNoConforme())
                                <label class="label label-success">TERMINADO</label>
                                @else
                                <label class="label label-warning">EN PROCESO</label>
                            @endif
                        @else
                            <label class="label label-warning">EN PROCESO</label>
                        @endif
                    </td>
                    <td>
                        @if($liquidacion->lote->produccionIngresoNoConforme() && $liquidacion->lote->loteSecadoNoConforme())
                            @if($liquidacion->lote->stockResultadoProduccionNoConforme())
                                <a href="{{route('liquidacion.reporte',$liquidacion->id)}}" target="_blank" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-print"></span> IMP.</a>
                            @else
                                <a href="#" target="_blank" class="btn btn-xs btn-info disabled"><span class="glyphicon glyphicon-print"></span> IMP.</a>
                            @endif
                        @else
                            <a href="#" target="_blank" class="btn btn-xs btn-info disabled"><span class="glyphicon glyphicon-print"></span> IMP.</a>
                        @endif
                        {{csrf_field()}}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$liquidaciones->links()}}
</div>