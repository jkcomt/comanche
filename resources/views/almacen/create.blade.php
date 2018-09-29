@extends('layout')

@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Registro Exitoso</h3>
@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>
    <a class="btn btn-sm btn-warning" href="{{route('almacen.index')}}">Volver</a>
@endsection

@section('header','Nuevo Almacen')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="msg-error" class="alert alert-danger" style="display:none;">
                    <strong>Corriga los campos indicados por favor.</strong>
                    {{--<ul>--}}
                    {{--@foreach($errors->all() as $error)--}}
                        {{--<li>{{$error}}</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                </div>
            <form action="{{route('almacen.create')}}" method="POST" id="registrarAlmacen">
                {{csrf_field()}}
                <div class="form-group col-md-6 ">
                   <label for="nombre" class="control-label">Nombre :</label>
                   <input type="text" class=" form-control" name="nombre" value="{{old('nombre')}}">
                </div>


                <div class="form-group col-md-12">
                    <button class="btn btn-success">Registrar</button>
                    <button class="btn btn-default" type="reset" id="limpiar">Limpiar</button>
                    <a href="{{route('almacen.index')}}" class="btn btn-warning " id="index">Volver</a>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/almacen.js')}}"></script>
@endsection