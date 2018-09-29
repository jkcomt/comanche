@extends('layout')

@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Registro Exitoso</h3>
@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>
    <a class="btn btn-sm btn-warning" href="{{route('comprador_empresa.index')}}">Volver</a>
@endsection

@section('header','Nueva Empresa ')
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
            <form action="{{route('comprador_empresa.create')}}" method="POST" id="registrarCompradorEmpresa">
                {{csrf_field()}}
                <div class="form-group col-md-6 ">
                    <label for="razon_social" class="control-label">Razón Social :</label>
                    <input type="text" class=" form-control" name="razon_social" value="{{old('razonsocial')}}" maxlength="30">
                </div>
                <div class="form-group col-md-6">
                    <label for="ruc" class="control-label">RUC :</label>
                    <input type="text" class="form-control" maxlength="12" name="ruc" value="{{old('ruc')}}" maxlength="12" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>

                <div class="form-group col-md-6">
                    <label for="" class="control-label">Dirección :</label>
                    <input type="text" class=" form-control" name="direccion" value="{{old('direccion')}}" maxlength="20">
                </div>

                <div class="form-group col-md-6">
                    <label for="telefono" class="control-label">Teléfono :</label>
                    <input type="text" class="form-control"  maxlength="12" form-control" name="telefono" value="{{old('telefono')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="control-label">E-mail :</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}"  maxlength="20">
                </div>
                <div class="form-group col-md-6">
                    <label for="representante" class="control-label">Representante :</label>
                    <input type="text" class="form-control" name="representante" value="{{old('representante')}}" maxlength="30" onkeypress="return lettersOnly(event)">
                </div>
                <div class="form-group col-md-6">
                    <label for="dni_representante" class="control-label">DNI del representante :</label>
                    <input type="text" maxlength="8" class="form-control" name="dni_representante" value="{{old('dni_representante')}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                </div>

                <div class="form-group col-md-12">
                    <button class="btn btn-success">Registrar</button>
                    <button class="btn btn-default" type="reset" id="limpiar">Limpiar</button>
                    <a href="{{route('comprador_empresa.index')}}" class="btn btn-warning " id="index">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/comprador_empresa.js')}}"></script>
@endsection
