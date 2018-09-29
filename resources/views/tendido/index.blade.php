@extends('layout')
@section('api')
    <style>
        th,td{
            text-align: center;
        }
    </style>

@endsection

@section('header','LISTADO DE TENDIDOS DE LOTE '.$loteSecado->nro_serie_guia )
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('tendido.index',['id'=>$loteSecado->id])}}">Volver</a>
@endsection

@section('modal-confirmacion-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-confirmacion-body')
    <h3 class="text-warning text-center">¿Desea eliminar el registro?</h3>
@endsection
@section('modal-confirmacion-footer')
    <button class="btn btn-danger confirmar" id="">Confirmar</button>
    <a href="" class="btn btn-warning " data-dismiss="modal" id="index" >Volver</a>
@endsection
@include('tendido.modals.detalle')
@section('content')
    {{--@include('tendido.modals.edit')--}}
    <div class="row">
        <div class="col-md-1">
            <a class="btn btn-warning" href="{{route('secado.index')}}">Volver</a>
        </div>
        <div class="col-md-2">
            <div class="form-group form-inline">

                <a href="@if(!$loteSecado->tendido->isEmpty() && $loteSecado->lote->nro_humedad_mayor_13 == $loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar'))#@else {{route('tendido.nuevo',['id'=>$loteSecado->id])}}@endif  "class="btn btn-success" @if($loteSecado->lote->nro_humedad_mayor_13 > $loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar'))@else disabled @endif>NUEVO TENDIDO</a>
            </div>
        </div>
        <div class="col-md-9">
            <form action="" class="form-inline text-right">
                <label for="">Nro. Guía</label>
                <input type="text" id="buscarTendido" placeholder="BUSCAR..." class="form-control">
                <input type="hidden" name="idlote" value="{{$loteSecado->id}}">
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-body">
                <strong><p style="font-size: 15px;">Nro. sacos enviados a secar: {{$loteSecado->lote->nro_humedad_mayor_13}}</p></strong>
                <?php $resultado = 0;
                  $resultado1 = 0;
                ?>
                @foreach($loteSecado->tendido->where('estado','Habilitado') as $tendido)
                    @php
                    $resultado += ($tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos'));
                    $resultado1 += ($tendido->nro_sacos_a_secar);
                    @endphp
                @endforeach
                @if(!$loteSecado->tendido->isEmpty())
                    {{--{{$ultimoRecojo =  $loteSecado->tendido->where('estado','Habilitado')->last()->recojo->where('estado','Habilitado')->last()}}--}}
                    @php
                    $ultimoTendido = $loteSecado->tendido->where('estado','Habilitado')->sortByDesc('fecha')->sortByDesc('hora')->first();

                    if(isset($ultimoTendido->recojo)){
                        $ultimoRecojo = $ultimoTendido->recojo->where('estado','Habilitado')->sortByDesc('hora')->first();
                    }
                    @endphp
                    @isset($ultimoRecojo)

                        @if($ultimoRecojo)
                            @if($ultimoRecojo->nro_sacos_no_recogidos == 0)
                                @if(($resultado1 - $resultado) > 0)
                                    <strong><p style="font-size: 15px;">Total de Nro. de sacos perdidos: {{$resultado1 - $resultado}}</p></strong>
                                @endif
                            @endif
                        @endif
                    @endisset
                @endif
            </div>
        </div>
    </div>
    <div class="row" id="tabla">
        @include('tendido.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/tendido.js')}}"></script>
@endsection