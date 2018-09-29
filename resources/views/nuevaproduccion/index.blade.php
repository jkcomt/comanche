@extends('layout')
@section('api')
    <style>
        th,td{
            text-align: center;
        }
    </style>

@endsection

@section('header','LISTADO DE SALIDAS DE PRODUCCIÓN '.$ingresoProduccion->nro_guia_ingreso)
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('nuevaproduccion.index',['id'=>$ingresoProduccion->id])}}">Volver</a>
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
@include('nuevaproduccion.modals.detalle')
@section('content')
    {{--@include('tendido.modals.edit')--}}
    <div class="row">
        <div class="col-md-1">
            <a class="btn btn-warning" href="{{route('produccion.index')}}">Volver</a>
        </div>
        <div class="col-md-2">
            <div class="form-group form-inline">
                <a href="{{route('nuevaproduccion.nuevo',['id'=>$ingresoProduccion->id])}}" class="btn btn-success @if($ingresoProduccion->nro_sacos_ingresados <= $ingresoProduccion->nuevaProduccion->where('estado','Habilitado')->sum('nro_sacos_a_procesar')) disabled @endif" >NUEVA PRODUCCIÓN</a>
            </div>
        </div>
        <div class="col-md-9">
            <form action="" class="form-inline text-right">
                <label for="" class="control-label">Nro. Guía : </label>
                <input type="text" id="buscarNuevaPro" placeholder="BUSCAR..." class="form-control">
                <input type="hidden" name="idIngresoProduccion" value="{{$ingresoProduccion->id}}" id="idIngresoProduccion">
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    {{--<div class="row">--}}
        {{--<div class="col-md-12 ">--}}
            {{--<div class="panel panel-body">--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row" id="tabla">--}}
        {{--@include('nuevaproduccion.tabla')--}}
    {{--</div>--}}
    <div class="row" id="tabla2">
        @include('nuevaproduccion.tabla')
    </div>
@endsection
@section('script')
    {{--<script src="{{asset('js/tendido.js')}}"></script>--}}
    <script src="{{asset('js/nuevaproduccion.js')}}"></script>
@endsection