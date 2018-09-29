@extends('layout')
@section('api')
    @include('apis.select2')
@endsection
{{-----------------------------------------------------------------}}
@section('modal-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-body')
    <h3 class="text-success text-center">Registro Exitoso</h3>
@endsection
@section('modal-footer')
    {{--<button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>--}}
    <a class="btn btn-sm btn-warning" href="{{route('tendido.index',['id'=>$loteSecado->id])}}">Volver</a>
@endsection
{{-----------------------------------------------------------------}}
@section('modal')
    @include('responsables.modals.create')
@endsection
@section('header','Nuevo Tendido')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
                <div id="msg-error" class="alert alert-danger" style="display:none;">
                    <strong>Corriga los campos indicados por favor.</strong>
                    <ul>
                    <div id="listaerrores">
                    </div>
                    </ul>
                    {{--<ul>--}}
                    {{--@foreach($errors->all() as $error)--}}
                        {{--<li>{{$error}}</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                </div>
            <div class="panel panel-default">
                    <div class="panel-heading">INFORMACIÓN DE RECEPCIÓN DE LOTES INGRESANTES</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="">
                            <div class="col-md-2 form-group">
                                <label for="">Campaña:</label>
                                <input type="text" name="" class="form-control" value="{{$loteSecado->lote->compania}}" readonly>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">Nro. Guía de Ingreso:</label>
                                <input type="text" name="" class="form-control" value="{{$loteSecado->lote->nro_guia}}" readonly maxlength="15">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">Fecha - Hora:</label>
                                <input type="text" name="" class="form-control" value="{{$loteSecado->lote->fecha.' - '.$loteSecado->lote->hora}}" readonly>
                            </div>
                                <div class="col-md-3">
                                    @if(!empty($loteSecado->lote->agricultor))
                                        <label for="">Agricultor:</label>
                                    <input type="text" class="form-control" value="{{$loteSecado->lote->agricultor->apellidos.' '.$loteSecado->lote->agricultor->nombres}}" readonly>
                                {{-- @elseif(!empty($loteSecado->lote->cliente))
                                    <label for="">Cliente</label>
                                    <input type="text" class="form-control" value="{{$loteSecado->lote->cliente->apellidos.' '.$loteSecado->lote->cliente->nombres}}" readonly> --}}
                                @elseif(!empty($loteSecado->lote->empresa))
                                    <label for="">Empresa</label>
                                    <input type="text" class="form-control" value="{{$loteSecado->lote->empresa->razon_social}}" readonly>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-2">
                                <label for="">Tipo de Peso:</label>
                                @if($loteSecado->lote->tipo_peso == 'sacos')
                                    <div class="center-block">
                                        Sacos
                                    </div>
                                @elseif($loteSecado->lote->tipo_peso == 'kilos')
                                    <div class="center-block">
                                        Kilos
                                    </div>
                                @endif
                            </div>
                            @if($loteSecado->lote->tipo_peso == 'sacos')
                                <div class="col-md-2">
                                    <label for="">Nro. Sacos:</label>
                                    <input type="text" name="" class="form-control" value="{{$loteSecado->lote->nro_sacos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Kilos:</label>
                                    <input type="text" name="lote_kilos" class="form-control" value="{{$loteSecado->lote->kilos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Peso Real (Kg):</label>
                                    <input type="text" name="" class="form-control" value="{{$loteSecado->lote->peso_real}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Variedad:</label>
                                    <input type="text" name="" class="form-control" value="{{$loteSecado->lote->variedad->descripcion}}" readonly>
                                </div>
                            @elseif($loteSecado->lote->tipo_peso == 'kilos')
                                <div class="col-md-2">
                                    <label for="">Peso Real (Kg):</label>
                                    <input type="text" name="" class="form-control" value="{{$loteSecado->lote->peso_real}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Nro. Sacos:</label>
                                    <input type="text" name="" class="form-control" value="{{$loteSecado->lote->nro_sacos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Kilos:</label>
                                    <input type="text" name="lote_kilos" class="form-control" value="{{$loteSecado->lote->kilos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Variedad:</label>
                                    <input type="text" name="" class="form-control" value="{{$loteSecado->lote->variedad->descripcion}}" readonly>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">INFORMACIÓN DE TENDIDO</div>
                <div class="panel-body">
                    <form action="{{route('tendido.create')}}" id="registrarTendido">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="lote_secado" value="{{($loteSecado->id)}}">
                                <label for="nro_guia_tendido" >Nro. Guía de Tendido:</label>
                                <input type="text" name="nro_guia_tendido" class="form-control" readonly value="@isset($tendido){{$tendido->generarSerieGuia()}}@else{{"TEN-000001"}}@endisset">
                            </div>
                            <div class="col-md-4">
                                <label for="fecha">Fecha - Hora:</label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="date" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control" name="fecha">
                                        <input type="time" value="{{\Carbon\Carbon::now()->toTimeString()}}" class="form-control" name="hora">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="responsable" class="control-label">Responsable de cuadrilla:</label>
                                <div class="input-group" id="responsableGroup">
                                    <select name="responsable" id="responsable" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($responsables as $key => $responsable)
                                            <option value="{{$key}}">{{$responsable}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addResponsable"><span class="glyphicon glyphicon-plus"></span></a>
                                        <button class="btn btn-warning" type="button" id="reloadResponsable" url="{{route('tendido.responsables')}}"><span class="glyphicon glyphicon-refresh"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nro Sacos Por Secar:</label>
                                        <input type="text" class="form-control" name="sacos_pendientes" value="@if($loteSecado->tendido->where('estado','Habilitado')->isEmpty()) {{$loteSecado->lote->nro_humedad_mayor_13}} @else {{$tendido->nro_sacos_no_secado}} @endif" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kilos Por Secar:</label>
                                        <input type="number" step="any" value="0" name="kilos_pendientes" class="form-control" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="sacos_secar" class="control-label">Nro Sacos a Secar:</label>
                                        <input type="number" step="any" value="0" name="sacos_secar" class="form-control" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kilos_secar">Kilos a Secar:</label>
                                        <input type="number" step="any" value="0" name="kilos_secar" class="form-control" min="0" max="200" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="sacos_restantes">Nro Sacos Restantes:</label>
                                        <input type="number" step="any" value="0" name="sacos_restantes" class="form-control" min="0" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kilos_restantes">Kilos Restantes:</label>
                                        <input type="number" step="any" value="0" name="kilos_restantes" class="form-control" min="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observación:</label>
                                <textarea name="observacion" id="" cols="30" rows="11" class="form-control" maxlength="50"></textarea>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success" id="btnTendido">Registrar</button>
                                <a href="{{route('tendido.index',['id'=>$loteSecado->id])}}" class="btn btn-warning">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/tendido.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
