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
    <button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>
    <a class="btn btn-sm btn-warning" href="{{route('lote.index')}}">Volver</a>
@endsection
{{-----------------------------------------------------------------}}
@section('modal')
    {{--@include('clientes.modals.create')--}}
    @include('agricultor.modals.create')
    @include('empresa.modals.create')
    @include('variedad.modals.create')
    @include('procedencia.modals.create')
    @include('chofer.modals.create')
    @include('vehiculo.modals.create')
@endsection
@section('header','Recepción de lotes ingresantes')
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
                <form action="{{route('lote.create')}}" id="registrarLote">
                    {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="campania" class="control-label">Campaña:</label>
                                <input type="text" value="{{\Carbon\Carbon::now()->format("Y")}}" class="form-control" name="campania" maxlength="20">
                            </div>
                            <div class="col-md-2">
                                <label for="" class="control-label">Nro. Guía:</label>
                                <input type="text" value="@isset($lote){{$lote->generarSerieGuia()}}@else {{"REC-000001"}}@endisset" class="form-control" readonly name="nro_guia" maxlength="15">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="control-label">Fecha - Hora:</label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="date" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control" name="fecha">
                                        <input type="time" value="{{\Carbon\Carbon::now()->toTimeString()}}" class="form-control" name="hora">
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4" id="grupoCliente">
                                <div class="radio-inline">
                                    <label for="control-label"><input type="radio" checked name="optradio" value="agricultor" id="rbAgri"> Agricultor</label>
                                </div>
                                {{--<div class="radio-inline">--}}
                                    {{--<label for="control-label"><input type="radio" name="optradio" value="cliente" id="rbCli"> Cliente</label>--}}
                                {{--</div>--}}
                                <div class="radio-inline">
                                    <label for="control-label"><input type="radio" name="optradio" value="empresa" id="rbEmp"> Empresa</label>
                                </div>
                                <div class="input-group" id="agricultorGroup">
                                    <select name="agricultor" id="agricultor" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($agricultores as $key => $agricultor)
                                            <option value="{{$key}}">{{$agricultor}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addAgricultor"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadAgricultor" url="{{route('lote.agricultores')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                </div>
                                {{--<div class="input-group" id="clienteGroup">--}}
                                    {{--<select name="cliente" id="cliente" class="form-control" >--}}
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        {{--<option></option>--}}
                                        {{--@foreach($clientes as $key => $cliente)--}}
                                            {{--<option value="{{$key}}">{{$cliente}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<span class="input-group-btn">--}}
                                        {{--<a href="#" class="btn btn-primary" type="button" id="addCliente"><span class="glyphicon glyphicon-plus"></span></a>--}}
                                        {{--<a href="#" class="btn btn-warning" type="button" id="reloadCliente" url="{{route('lote.clientes')}}"><span class="glyphicon glyphicon-refresh"></span></a>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                                <div class="input-group" id="empresaGroup">
                                    <select name="empresa" id="empresa" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($empresas as $key => $empresa)
                                            <option value="{{$key}}">{{$empresa}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addEmpresa"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadEmpresa" url="{{route('lote.empresas')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="grupoVariedad">
                                <label for="" class="control-label">Variedad de cáscara:</label>
                                <div class="input-group">
                                    <select name="variedad" id="variedad" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($variedades as $key => $variedad)
                                            <option value="{{$key}}">{{$variedad}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addVariedad"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadVariedad" url="{{route('lote.variedades')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label for="">Tipo Peso</label>
                                    <div class="center-block" style="">
                                    <label class="radio-inline">
                                        <input type="radio" name="rbtipoPeso" checked id="radioPeso" value="sacos"> Sacos
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="rbtipoPeso" id="radioPeso" value="kilos"> Kilos
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="sacos-grupo">
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nro_sacos">Nro. Sacos</label>
                                        <input type="number" class="form-control" name="nro_sacos" min="0" value="0" >
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kilos">Kilos:</label>
                                        <input type="number" class="form-control" name="kilos" step="any" min="0" value="0">
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Peso Real(Kg):</label>
                                        <input type="number" class="form-control" name="pesoreal" readonly step="2" min="0" value="0">
                                    </div>
                                    </div>
                                </div>
                                <div class="kilos-grupo">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Peso Real(Kg)</label>
                                            <input type="number" class="form-control" name="kilos_pesoreal" value="" step="any" min="0" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nro. Sacos</label>
                                            <input type="number" class="form-control" name="kilos_nro_sacos" min="0" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Kilos:</label>
                                            <input type="number" class="form-control" name="kilos_kilos" readonly step="any" min="0" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4" id="grupoProcedencia">
                                <label for="" class="control-label">Origen:</label>
                                <div class="input-group">
                                    <select name="procedencia" id="procedencia" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($procedencias as $key => $procedencia)
                                            <option value="{{$key}}">{{$procedencia}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addProcedencia"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadProcedencia" url="{{route('lote.procedencias')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Tipo de flete:</label><br>
                                <label class="radio-inline">
                                    <input type="radio" checked name="rbtipoflete" id="fleteSaco" value="fleteSaco"> Saco
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rbtipoflete" id="fleteSaco" value="fletePeso"> Peso
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="rbtipoflete" id="fleteSaco" value="fleteTonelada"> Tonelada
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label for="">Pagado por:</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="pagadopor" id="pagadoporCliente" checked value="Agricultor">
                                    <label for="pagadoporCliente">Agricultor\Cliente</label>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="pagadopor" id="pagadoporMolino" value="Molino">
                                    <label for="pagadoporMolino">Molino</label>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="fletexSaco" class="">Flete x Saco:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">S/</span>
                                    <input type="number" value="0" class="form-control" name="fletexSaco" step="any" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Flete x Peso:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">S/</span>
                                    <input type="number" value="0" class="form-control" name="fletexPeso" step="any" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Flete x Tonelada:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">S/</span>
                                    <input type="number" value="0" class="form-control" name="fletexTonelada" step="any" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Flete Total:</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">S/</span>
                                    <input type="number" value="0" class="form-control" name="fletexTotal" readonly step="any" min="0">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4" id="grupoChofer">
                                <label for="chofer" class="control-label">Chofer:</label>
                                <div class="input-group">
                                    <select name="chofer" id="chofer" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($choferes as $key => $chofer)
                                            <option value="{{$key}}">{{$chofer}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addChofer"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadChofer" url="{{route('lote.choferes')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4" id="grupoVehiculo">
                                <label for="vehiculo" class="control-label">Vehículo:</label>
                                <div class="input-group">
                                    <select name="vehiculo" id="vehiculo" class="form-control" >
                                        {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                        <option></option>
                                        @foreach($vehiculos as $key => $vehiculo)
                                            <option value="{{$key}}">{{$vehiculo}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addVehiculo"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadVehiculo" url="{{route('lote.vehiculos')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3" id="mayor13group">
                                <label for="nro_sacos_mayor_13" class="">Nro Sacos % humedad > 13:</label>
                                <input type="number" value="0" class="form-control" name="nro_sacos_mayor_13" min="0">
                            </div>
                            <div class="col-md-3">
                                <label for="condicion_mayor_13" class="">Condición:</label>
                                <input type="text" value="Vacío" class="form-control" readonly name="condicion_mayor_13">
                            </div>
                            <div class="col-md-3" id="menor13group">
                                <label for="nro_sacos_menor_13" class="">Nro Sacos % humedad <= 13:</label>
                                <input type="number" value="0" class="form-control" name="nro_sacos_menor_13" min="0">
                            </div>
                            <div class="col-md-3" >
                                <label for="" class="">Condición:</label>
                                <input type="text" value="Vacío" class="form-control" readonly name="condicion_menor_13">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                            <label for="" >Observación:</label>
                            <textarea id="" cols="30" rows="5" class="form-control" name="observacion"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success">Registrar</button>
                                <button class="btn btn-default" id="limpiar" type="button">Limpiar</button>
                                <a href="{{route('lote.index')}}" class="btn btn-warning " id="index">Volver</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/lote.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
