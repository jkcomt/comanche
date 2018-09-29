@extends('layout')
@section('api')
    @include('apis.select2')
@endsection
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Registro Exitoso</h3>
@endsection

@section('modal-footer')
    <button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>
    <a class="btn btn-sm btn-warning" href="{{route('usuario.index')}}">Volver</a>
@endsection

@section('header','Nuevo Usuario ')
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
            <form action="{{route('usuario.create')}}" method="POST" id="registrarUsuario">
                {{csrf_field()}}
                <div class="form-group col-md-12 ">
                   <label for="" class="control-label">Personal :</label>
                    <select name="personal" id="personal" class="form-control">
                   {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                    <option></option>
                    @foreach($personales as $key => $personal)
                        <option value="{{$key}}">{{$personal}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="" class="control-label  ">Área :</label>
                    <select name="area" id="area" class="form-control">
                        <option></option>
                        @foreach($areas as $key => $area)
                            <option value="{{$key}}">{{ucfirst($area)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-12">
                   <label for="name" class="control-label">Nick :</label>
                   <input type="text" class="form-control" name="name" value="{{old('nick')}}" onkeypress="return lettersOnly(event)" maxlength="10">
                </div>

                <div class="form-group col-md-12">
                    <label for="password" class="control-label">Password :</label>
                    {{--<input type="password" class=" form-control" name="password" value="">--}}
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" value="" maxlength="10">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id="mostrarpassword"><span class="glyphicon glyphicon-eye-open"></span></button>
                    </span>
                    </div><!-- /input-group -->
                </div>

                {{--<div class="form-group col-md-12">--}}
                    {{--<label for="email" class="control-label">E-mail :</label>--}}
                    {{--<input type="email" class="form-control" name="email" value="{{old('email')}}">--}}
                {{--</div>--}}

                <div class="form-group col-md-12">
                    <button class="btn btn-success">Registrar</button>
                    <button class="btn btn-default" type="reset" id="limpiar">Limpiar</button>
                    <a href="{{route('usuario.index')}}" class="btn btn-warning " id="index">Volver</a>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/usuario.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
