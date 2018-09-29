@extends('layout')

@section('header','Almacenes')
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Eliminación Exitosa</h3>
@endsection
@section('modal-footer')
    <a class="btn btn-sm btn-warning" href="{{route('almacen.index')}}">Volver</a>
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
    @include('almacen.modals.edit')

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <a href="{{route('almacen.nuevo')}}" class="btn btn-success">NUEVO ALMACEN</a>
            </div>
        </div>
        <div class="col-md-9">
            <form action="" class="form-inline">
                {{--<input type="text" placeholder="BUSCAR..." class="form-control">--}}
                {{--<button class="btn btn-primary form-control">BUSCAR</button>--}}
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <table class="table table-hover table-condensed box">
                <thead>
                <th>NOMBRE</th>
                <th>ACCIONES</th>
                </thead>
                <tbody>
                @foreach($almacenes as $almacen)
                    <tr>
                        <td>{{$almacen->nombre}}</td>
                        <td>
                            {{--<a href="#" class="btn btn-xs btn-info "><span class="glyphicon glyphicon-info-sign"></span> DET.</a>--}}
                            <a href="#" class="btn btn-xs btn-warning edit"  value="{{$almacen->id}}"><span class="glyphicon glyphicon-pencil"></span> EDIT.</a>
                            {{csrf_field()}}
                            @if(auth()->user()->area->descripcion == 'administrador')
                            <a href="#" class="btn btn-xs btn-danger delete"  id="{{$almacen->id}}"><span class="glyphicon glyphicon-remove"></span> ELIM.</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$almacenes->links()}}
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/almacen.js')}}"></script>
@endsection