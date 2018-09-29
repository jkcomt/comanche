@extends('layout')
@section('api')
    <style>
        th,td{
            text-align: center;
        }
    </style>

@endsection

@section('header','LISTADO DE INGRESOS A PRODUCCIÓN')
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('produccion.index')}}">Volver</a>
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

@section('content')
    @include('produccion.modals.detalle')

    <div class="row">
        <div class="col-md-2">
            {{--<div class="form-group">--}}
                {{--<a href="{{route('lote.nuevo')}}" class="btn btn-success">NUEVO LOTE</a>--}}
            {{--</div>--}}
        </div>
        <div class="col-md-10">
            <form action="" class="form-inline text-right">
                <select name="filtro" id="filtro" class="form-control">
                    <option value="guia">Nro. Guía</option>
                    <option value="persona">Agricultor</option>
                    <option value="empresa">Empresa</option>
                </select>
                <input type="text" id="buscarProduccionIngreso" placeholder="BUSCAR..." class="form-control" style="width: 45%">
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    <div class="row" id="tabla">
        @include('produccion.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/produccion.js')}}"></script>
@endsection