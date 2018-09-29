@extends('layout')
@section('api')
    <style>
        th,td{
            text-align: center;
        }
    </style>

@endsection

@section('header','LISTADO DE VENTAS')
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('ventas.index')}}">Volver</a>
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
    @include('ventas.modals.detalle')

    <div class="row">
        <div class="col-md-1">
            <div class="form-group">
            <a href="{{route('ventas.nuevo')}}" class="btn btn-success">NUEVA VENTA</a>
            </div>
        </div>
        <form action="{{route('ventas.search')}}" class="form-inline" id="filtroVenta">
        <div class="col-md-6 form-inline text-center">

            <div class="form-group">
                <label for="">F. Desde:</label>
                <input type="date" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control" name="fecha_desde">
            </div>
            <div class="form-group">
                <label for="">F. Hasta:</label>
                <input type="date" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control" name="fecha_hasta">
            </div>
        </div>
        <div class="col-md-5">
                <select name="filtro" id="filtro" class="form-control">
                    <option value="">Seleccione filtro</option>
                    <option value="persona">Persona</option>
                    <option value="empresa">Empresa</option>
                </select>
                <input type="text" id="buscarVentas" placeholder="BUSCAR..." name="buscador" class="form-control" >
                <button class="btn btn-primary form-control" type="submit">BUSCAR</button>
                <button class="btn btn-info form-control" type="reset"><i class="glyphicon glyphicon-erase"></i></button>
        </div>
        </form>
    </div>
    <br>
    <div class="row" id="tabla">
        @include('ventas.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/ventas.js')}}"></script>
@endsection