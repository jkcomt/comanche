@extends('layout')

@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Registro Exitoso</h3>
@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>
    <a class="btn btn-sm btn-warning" href="{{route('cliente.index')}}">Volver</a>
@endsection

@section('header','Nuevo Cliente ')
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
            <form action="{{route('cliente.create')}}" method="POST" id="registrarCliente">
                {{csrf_field()}}
                <div class="form-group col-md-6 ">
                   <label for="apellidos" class="control-label">Apellidos :</label>
                   <input type="text" class=" form-control" name="apellidos" value="{{old('apellido')}}">
                </div>
                <div class="form-group col-md-6">
                   <label for="nombres" class="control-label">Nombres :</label>
                   <input type="text" class="form-control" name="nombres" value="{{old('nombres')}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="dni" class="control-label">DNI :</label>
                    <input type="text" maxlength="8" class=" form-control" name="dni" value="{{old('dni')}}"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="form-group col-md-6">
                    <label for="celular" class="control-label">Celular :</label>
                    <input type="number" class="form-control" name="celular" value="{{old('celular')}}">
                </div>

                <div class="form-group col-md-6">
                    <label for="direccion" class="control-label">Dirección :</label>
                    <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="control-label">E-mail :</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="ruc" class="control-label">RUC :</label>
                    <input type="text" class="form-control" name="ruc" value="{{old('ruc')}}">
                </div>

                <div class="form-group col-md-12">
                    <button class="btn btn-success">Registrar</button>
                    <button class="btn btn-default" type="reset" id="limpiar">Limpiar</button>
                    <a href="{{route('cliente.index')}}" class="btn btn-warning " id="index">Volver</a>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/cliente.js')}}"></script>
@endsection