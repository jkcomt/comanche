@extends('layout')

@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Registro Exitoso</h3>
@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>
    <a class="btn btn-sm btn-warning" href="{{route('vehiculo.index')}}">Volver</a>
@endsection

@section('header','Nuevo Vehículo')
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
            <form action="{{route('vehiculo.create')}}" method="POST" id="registrarVehiculo">
                {{csrf_field()}}
                <div class="form-group col-md-6 ">
                   <label for="marca" class="control-label">Marca :</label>
                   <input type="text" class=" form-control" name="marca" value="{{old('marca')}}" maxlength="20">
                </div>
                <div class="form-group col-md-6">
                   <label for="descripcion" class="control-label">Descripción :</label>
                   <input type="text" class="form-control" name="descripcion" value="{{old('descripcion')}}" maxlength="20">
                </div>

                <div class="form-group col-md-6">
                    <label for="placa" class="control-label">Placa :</label>
                    <input type="text" class=" form-control" name="placa" value="{{old('placa')}}" maxlength="8">
                </div>


                <div class="form-group col-md-12">
                    <button class="btn btn-success">Registrar</button>
                    <button class="btn btn-default" type="reset" id="limpiar">Limpiar</button>
                    <a href="{{route('vehiculo.index')}}" class="btn btn-warning " id="index">Volver</a>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/vehiculo.js')}}"></script>
@endsection
