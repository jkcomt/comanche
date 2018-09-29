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
    <a class="btn btn-sm btn-warning" href="{{route('recojo.index',['id'=>$tendido->id])}}">Volver</a>
@endsection
{{-----------------------------------------------------------------}}
@section('modal')
    {{--@include('responsables.modals.create')--}}
@endsection
@section('header','Nuevo Recojo')
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
                                <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->compania}}" readonly>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">Nro. Guía de Ingreso:</label>
                                <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->nro_guia}}" readonly>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="">Fecha - Hora:</label>
                                <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->fecha.' - '.$tendido->loteSecado->lote->hora}}" readonly>
                            </div>
                                <div class="col-md-3">
                                    @if(!empty($tendido->loteSecado->lote->agricultor))
                                        <label for="">Agricultor:</label>
                                        <input type="text" class="form-control input-sm" value="{{$tendido->loteSecado->lote->agricultor->apellidos.' '.$tendido->loteSecado->lote->agricultor->nombres}}" readonly>
                                    @elseif(!empty($tendido->loteSecado->lote->cliente))
                                        <label for="">Cliente</label>
                                        <input type="text" class="form-control input-sm" value="{{$tendido->loteSecado->lote->cliente->apellidos.' '.$tendido->loteSecado->lote->cliente->nombres}}" readonly>
                                    @elseif(!empty($tendido->loteSecado->lote->empresa))
                                        <label for="">Empresa</label>
                                        <input type="text" class="form-control input-sm" value="{{$tendido->loteSecado->lote->empresa->razon_social}}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">Tipo de Peso:</label>
                                @if($tendido->loteSecado->lote->tipo_peso == 'sacos')
                                    <div class="center-block">
                                        Sacos
                                    </div>
                                @elseif($tendido->loteSecado->lote->tipo_peso == 'kilos')
                                    <div class="center-block">
                                        Kilos
                                    </div>
                                @endif
                            </div>
                            @if($tendido->loteSecado->lote->tipo_peso == 'sacos')
                                <div class="col-md-2">
                                    <label for="">Nro. Sacos:</label>
                                    <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->nro_sacos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Kilos:</label>
                                    <input type="text" name="lote_kilos" class="form-control input-sm" value="{{$tendido->loteSecado->lote->kilos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Peso Real (Kg):</label>
                                    <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->peso_real}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Variedad:</label>
                                    <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->variedad->descripcion}}" readonly>
                                </div>
                            @elseif($tendido->loteSecado->lote->tipo_peso == 'kilos')
                                <div class="col-md-2">
                                    <label for="">Peso Real (Kg):</label>
                                    <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->peso_real}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Nro. Sacos:</label>
                                    <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->nro_sacos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Kilos:</label>
                                    <input type="text" name="lote_kilos" class="form-control input-sm" value="{{$tendido->loteSecado->lote->kilos}}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Variedad:</label>
                                    <input type="text" name="" class="form-control input-sm" value="{{$tendido->loteSecado->lote->variedad->descripcion}}" readonly>
                                </div>
                            @endif

                        </div>
                    </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">INFORMACIÓN DE TENDIDO</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="lote_secado" value="">
                                <label for="nro_guia_tendido" >Nro. Guía de Tendido:</label>
                                <input type="text" name="nro_guia_tendido" class="form-control input-sm" value="{{$tendido->nro_guia_tendido}}" readonly value="">
                            </div>
                            <div class="col-md-4">
                                <label for="fecha">Fecha - Hora:</label>
                                <input name="fecha" type="text" class="form-control input-sm" value="{{$tendido->fecha.' - '.$tendido->hora}}" readonly="">
                            </div>
                            <div class="col-md-4">
                                <label for="responsable" class="control-label">Responsable de cuadrilla:</label>
                                <div class="" id="responsableGroup">
                                    <input type="text" class="form-control input-sm" name="responsable" value="{{$tendido->responsable->apellidos.' '.$tendido->responsable->nombres}}" readonly>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Nro Sacos Por Secar:</label>
                                        <input type="text" class="form-control input-sm" name="sacos_pendientes" value="{{$tendido->nro_sacos_pre_secado}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kilos Por Secar:</label>
                                        <input type="number" step="any" value="{{$tendido->kilos_pre_secado}}" name="kilos_pendientes" class="form-control input-sm" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="sacos_secar" class="control-label">Nro Sacos a Secar:</label>
                                        <input type="number" step="any" value="{{$tendido->nro_sacos_a_secar}}" name="sacos_secar" class="form-control input-sm" min="0" readonly="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kilos_secar">Kilos a Secar:</label>
                                        <input type="number" step="any" value="{{$tendido->kilos_a_secar}}" name="kilos_secar" class="form-control input-sm" min="0" max="200" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="sacos_restantes">Nro Sacos Restantes:</label>
                                        <input type="number" step="any" value="{{$tendido->nro_sacos_no_secado}}" name="sacos_restantes" class="form-control input-sm" min="0" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kilos_restantes">Kilos Restantes:</label>
                                        <input type="number" step="any" value="{{$tendido->kilos_no_secado}}" name="kilos_restantes" class="form-control input-sm" min="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observación:</label>
                                <textarea name="observacion" id="" cols="30" rows="11" class="form-control input-sm" readonly>{{$tendido->observacion}}</textarea>
                            </div>

                        </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">INFORMACIÓN DE RECOJO</div>

                <div class="panel-body">
                    <form action="{{route('recojo.create')}}" id="registrarRecojo">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-3">
                                <input type="hidden" value="{{$tendido->id}}" name="tendido">
                                <label for="nro_guia_recojo" >Nro. Guía de Recojo:</label>
                                <input type="text" name="nro_guia_recojo" class="form-control input-sm" value="@isset($recojo){{$recojo->generarSerieGuia()}}@else{{"RCJ-000001"}}@endisset" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="" >Nro. Sacos Tendidos:</label>
                                <input type="text" readonly="true" class="form-control input-sm" value="{{$tendido->nro_sacos_a_secar}}" name="nroSacosTendidos" >
                            </div>
                            <div class="col-md-3">
                                <label for="" >Nro. Sacos Recogidos Anteriormente:</label>
                                {{--<input type="text" readonly="true" class="form-control input-sm" value="{{$tendido->recojo->sum('nro_sacos_recogidos')}}">--}}
                                <input type="text" readonly="true" class="form-control input-sm" value="{{$tendido->sumaRecojos()}}" name="nro_saco_recogidos_anteriormente">
                            </div>
                            <div class="col-md-4">
                                <label for="fecha_recojo">Fecha - Hora:</label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="date" value="{{\Carbon\Carbon::now()->toDateString()}}" class="form-control input-sm" name="fecha_recojo">
                                        <input type="time" value="{{\Carbon\Carbon::now()->toTimeString()}}" class="form-control input-sm" name="hora_recojo">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" value="{{$tendido->loteSecado->sumatotalrecojos()}}" name="sumatotalrecojos">
                                <input type="hidden" value="{{$tendido->loteSecado->lote->peso_real}}" name="pesorealrecepcion">
                                <label for="nro_sacos_recogidos" class="control-label">Nro. Sacos Recogidos:</label>
                                <input type="text" step="any" name="nro_sacos_recogidos" class="form-control input-sm"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            </div>
                            <div class="col-md-4">
                                <label for="kilos_recogidos" class="control-label">Kilos Recogidos:</label>
                                <input name="kilos_recogidos" type="number" step="any" class="form-control input-sm" value=""  step="any">
                            </div>
                            <div class="col-md-4">
                                <label for="pesos_recogidos" class="control-label">Peso Recogidos (Kg): </label>
                                <input name="pesos_recogidos" type="number" step="any" class="form-control input-sm" value="" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nro_sacos_no_recogidos" class="control-label">Nro. Sacos No Recogidos:</label>
                                <input type="text" name="nro_sacos_no_recogidos" class="form-control input-sm" value="" step="any">
                            </div>
                            <div class="col-md-4">
                                <label for="kilos_no_recogidos" class="control-label">Kilos No Recogidos:</label>
                                <input name="kilos_no_recogidos" type="number" class="form-control input-sm" value=""  step="any">
                            </div>
                            <div class="col-md-4">
                                <label for="peso_no_recogido">Peso No Recogidos (Kg):</label>
                                <input name="peso_no_recogido" type="text" class="form-control input-sm" value="" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="importe_sacos" class="control-label">Importe S/ x Saco: (Kg):</label>
                                        <input name="importe_sacos" type="text" class="form-control input-sm" value="" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="importe_total">Total S/ :</label>
                                        <input name="importe_total" type="text" class="form-control input-sm" value="" readonly>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="almacen">Almacen Destino :</label>
                                        {{--<input name="almacen" type="text" class="form-control input-sm" value="" >--}}
                                        <select name="almacen" id="" class="form-control input-sm">
                                            @foreach($almacenes as $almacen)
                                                <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 ">
                                       <label for="humedad_al_recoger">Humedad al recogerse % :</label>
                                       <input  name="humedad_al_recoger" type="number" class="form-control input-sm" value="" step="any">
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div class="col-md-6">
                                <label for="">Observación:</label>
                                <textarea name="observacion" id="" cols="30" rows="5" class="form-control input-sm" maxlength="50"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success">Registrar</button>
                                <a href="{{route('recojo.index',['id'=>$tendido->id])}}" class="btn btn-warning">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('js/recojo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
