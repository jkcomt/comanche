@extends('layout')

@section('header','Usuarios')
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('usuario.index')}}">Volver</a>
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
    @include('usuario.modals.edit')

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <a href="{{route('usuario.nuevo')}}" class="btn btn-success">NUEVO USUARIO</a>
            </div>
        </div>
        <div class="col-md-10">
            <form action="" class="form-inline text-right">
                <input type="text" id="buscarUsuario" placeholder="BUSCAR..." class="form-control">
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    <div class="row" id="tabla">
        @include('usuario.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/usuario.js')}}"></script>
@endsection