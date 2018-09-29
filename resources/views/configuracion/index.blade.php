@extends('layout')

@section('header','Configuración')

@section('content')

    <div class="row text-center">
      
        <div class="col-lg-2" >
            <a href="{{route('usuario.index')}}" class="btn btn-lg btn-block btn-default" ><h3><span class="fa fa-users"></span></h3> <strong>Usuarios</strong></a>
        </div>
        <div class="col-lg-2">
            <a href="{{route('personal.index')}}" class="btn btn-lg btn-block btn-default" ><h3><span class="fa fa-user"></span></h3> <strong>Personal</strong></a>
        </div>
        <div class="col-lg-2">
            {{--<a href="{{route('area.index')}}" class="btn btn-lg btn-block btn-default" ><h3><span class="fa fa-cubes"></span></h3> <strong>Áreas</strong></a>--}}
        </div>

    </div>

@endsection
@section('script')

@endsection
