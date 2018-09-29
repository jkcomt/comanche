@extends('layout')

@section('header','Personas')

@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('comprador_persona.index')}}">Volver</a>
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
    @include('comprador_persona.modals.edit')

    <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                <a href="{{route('comprador_persona.nuevo')}}" class="btn btn-success">NUEVA PERSONA</a>
                </div>
            </div>
            <div class="col-md-10">
                <form action="" class="form-inline text-right">
                    <input type="text" id="buscarPersona" placeholder="BUSCAR..." class="form-control">
                    {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
                </form>
            </div>
    </div>
    <br>
    <div class="row"  id="tabla">
        @include('comprador_persona.tabla')
    </div>
@endsection
@section('script')
    <script src="{{asset('js/comprador_persona.js')}}"></script>
@endsection