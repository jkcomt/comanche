@extends('layout')
@section('api')
    <style>
        th,td{
            text-align: center;
        }
    </style>
@endsection

@section('header','LISTADO DE RECOJOS DE '.$tendido->nro_guia_tendido )
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="">Volver</a>
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
@include('recojo.modals.detalle')
@section('content')
    {{--@include('tendido.modals.edit')--}}
    <div class="row">
        <div class="col-md-1">
            <a class="btn btn-warning" href="{{route('tendido.index',['id'=>$tendido->loteSecado->id])}}">Volver</a>
        </div>
        <div class="col-md-2">
            <div class="form-group form-inline">
                <a href="@if($tendido->ultimoNroSacosNoRecogidos()) # @else {{route('recojo.nuevo',['id'=>$tendido->id])}} @endif" class="btn btn-success" @if($tendido->ultimoNroSacosNoRecogidos()) disabled @endif>NUEVO RECOJO</a>
            </div>
        </div>
        <div class="col-md-9">
            <form action="" class="form-inline text-right">
                <label for="">Nro. Guía</label>
                <input type="text" placeholder="BUSCAR..." class="form-control" id="buscarRecojo">
                <input type="hidden" name="idtendido" value="{{$tendido->id}}">
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-body">
                <strong><p style="font-size: 15px;">Nro Sacos Tendidos: {{$tendido->nro_sacos_a_secar}}</p></strong>
                @isset($tendido->recojo->where('estado','Habilitado')->last()->nro_sacos_no_recogidos)
                    @if($tendido->recojo->where('estado','Habilitado')->last()->nro_sacos_no_recogidos <= 0)
                        @if($tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos') < $tendido->nro_sacos_a_secar)
                            <strong><p style="font-size: 15px;">Hay una pérdida de {{$tendido->nro_sacos_a_secar - $tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos')}} sacos</p></strong>
                        @endif
                    @endif
                @endisset
            </div>
        </div>
    </div>
    <div class="row" id="tabla">
        @include('recojo.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/recojo.js')}}"></script>
@endsection