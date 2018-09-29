<div class="col-lg-12 col-md-12 col-sm-12">
    <table class="table table-responsive table-hover table-condensed small box">
        <thead>
        <th>CAMPAÑA</th>
        <th>FECHA</th>
        <th>N° GUÍA</th>
        <th>AGRICULTOR\EMPRESA</th>
        <th>VARIEDAD CÁSCARA</th>
        <th>N° SACOS</th>
        <th>CONFORME</th>
        <th>ACCIONES</th>
        </thead>
        <tbody>
        @foreach($lotes as $lote)
            @if($lote->estado == 'Habilitado')
            <tr>
                <td>{{$lote->compania}}</td>
                <td>{{$lote->fecha}} {{ Carbon\Carbon::parse($lote->hora)->format('H:i:s A') }}</td>
                <td>{{$lote->nro_guia}}</td>
                @if($lote->agricultor)
                    <td>{{$lote->agricultor->apellidos}} {{$lote->agricultor->nombres}}</td>
                @elseif($lote->empresa)
                    <td>{{$lote->empresa->razon_social}}</td>
                @endif
                <td>{{$lote->variedad->descripcion}}</td>
                <td>{{$lote->nro_sacos}}</td>
                <td>
                    <a href="#" class="btn btn-xs btn-primary @if($lote->conforme)  @else conformidad @endif" lote="{{$lote->id}}" @if($lote->conforme) disabled @endif>@if($lote->conforme) SI @else NO @endif</a>
                </td>
                <td>
                    <a href="#" class="btn btn-xs btn-default detalle" value="{{$lote->id}}"><span class="glyphicon glyphicon-info-sign"></span> DET.</a>
                    <a href="{{route('lote.reporte',$lote->id)}}" target="_blank" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-print"></span> IMP.</a>
                    {{csrf_field()}}
                    <a href="#" class="btn btn-xs btn-danger @if($lote->conforme)  @elseif($lote->ultimoLote()->id > $lote->id) @else delete @endif"  id="{{$lote->id}}"  @if($lote->conforme) disabled  @elseif($lote->ultimoLote()->id > $lote->id) disabled @endif><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    {{$lotes->links()}}
</div>
