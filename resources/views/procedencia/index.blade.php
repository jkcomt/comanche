@extends('layout')

@section('header','Origen de Procedencias')
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('procedencia.index')}}">Volver</a>
@endsection

@section('modal-confirmacion-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-confirmacion-body')
    <h3 class="text-warning text-center">¿Desea eliminar el registro?</h3>
@endsection
@section('modal-confirmacion-footer')
    <button class="btn btn-danger confirmar" id="">Confirmar</button>
    <a href="" class="btn btn-warning " data-dismiss="modal" id="index">Volver</a>
@endsection

@section('content')
    @include('procedencia.modals.edit')

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <a href="{{route('procedencia.nuevo')}}" class="btn btn-success">NUEVO ORIG. DE PROCEDENCIA</a>
            </div>
        </div>
        <div class="col-md-9">
            <form action="" class="form-inline text-right">
                <input type="text" id="buscarProcedencia" placeholder="BUSCAR..." class="form-control">
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    <div class="row" id="tabla">
        @include('procedencia.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/procedencia.js')}}"></script>
@endsection