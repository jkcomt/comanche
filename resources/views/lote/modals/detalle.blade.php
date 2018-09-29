<div class="modal fade" tabindex="-1" role="dialog" id="modal-lote-detalle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalle Lote</h4>
            </div>
            <div class="modal-body">
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
            <div class="">
                <form action="" id="detalleLote">
                    {{csrf_field()}}
                    <div class="">
                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="campania" class="control-label">Campaña:</label>
                                <input type="text" value="2018" class="form-control" name="campania" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="control-label">Nro. Guía:</label>
                                <input type="text" value="" class="form-control" readonly name="nro_guia">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="control-label">Fecha - Hora:</label>
                                <input type="datetime" value="" class="form-control" name="fecha" readonly>
                            </div>
                            <div class="col-md-4" id="grupoCliente">

                                <div class="" id="agricultorGroup">
                                    <label class="control-label" name="lblCliente">
                                        Agricultor
                                    </label>
                                    <input type="text" class=" form-control" id="clienteAgricultor" value="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="grupoVariedad">
                                <label for="" class="control-label">Variedad de cáscara:</label>
                                <div class="">
                                    <input type="text" class=" form-control" id="variedad" value="" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label for="">Tipo Peso</label>
                                    <div class="center-block" style="">
                                        <label class="radio-inline"  name="lblTipoPeso">
                                                {{--<input type="radio" name="rbtipoPeso" checked id="radioPeso" value="sacos"> --}}
                                            Sacos
                                        </label>
                                        {{--<label class="radio-inline">--}}
                                            {{--<input type="radio" name="rbtipoPeso" id="radioPeso" value="kilos"> Kilos--}}
                                        {{--</label>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="sacos-grupo">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" name="lblPeso1">Nro. Sacos</label>
                                            <input type="number" class="form-control" name="nro_sacos" min="0" value="0" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" name="lblPeso2">Kilos:</label>
                                            <input type="number" class="form-control" name="kilos" step="any" min="0" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""  name="lblPeso3">Peso Real(Kg):</label>
                                            <input type="number" class="form-control" name="pesoreal" readonly step="2" min="0" value="0">
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="kilos-grupo">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="">Peso Real(Kg)</label>--}}
                                            {{--<input type="number" class="form-control" name="kilos_pesoreal" value="" step="any" min="0" value="0">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="">Nro. Sacos</label>--}}
                                            {{--<input type="number" class="form-control" name="kilos_nro_sacos" min="0" value="0">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="">Kilos:</label>--}}
                                            {{--<input type="number" class="form-control" name="kilos_kilos" readonly step="any" min="0" value="0">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4" id="grupoProcedencia">
                                <label for="" class="control-label">Origen:</label>
                                <div class="    ">
                                    <input type="text" class=" form-control" name="procedencia" value="" readonly>
                                    {{--<select name="procedencia" id="procedencia" class="form-control" >--}}
                                        {{--<option></option>--}}
                                        {{--@foreach($procedencias as $key => $procedencia)--}}
                                            {{--<option value="{{$key}}">{{$procedencia}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<span class="input-group-btn">--}}
                                        {{--<a href="#" class="btn btn-default" type="button" id="addProcedencia"><span class="glyphicon glyphicon-plus"></span></a>--}}
                                        {{--<a href="#" class="btn btn-default" type="button" id="reloadProcedencia" url="{{route('lote.procedencias')}}"><span class="glyphicon glyphicon-refresh"></span></a>--}}
                                    {{--</span>--}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Tipo de flete:</label><br>
                                <label class="radio-inline" name="lblTipoFlete">
                                    {{--<input type="radio" checked name="rbtipoflete" id="fleteSaco" value="fleteSaco"> --}}
                                    Saco
                                </label>
                                {{--<label class="radio-inline">--}}
                                    {{--<input type="radio" name="rbtipoflete" id="fleteSaco" value="fletePeso"> Peso--}}
                                {{--</label>--}}
                                {{--<label class="radio-inline">--}}
                                    {{--<input type="radio" name="rbtipoflete" id="fleteSaco" value="fleteTonelada"> Tonelada--}}
                                {{--</label>--}}
                            </div>
                            <div class="col-md-4">
                                <label for="">Pagado por:</label><br>
                                <label class="" name="pagadoPor">
                                    {{--<input type="radio" name="pagadopor" id="pagadoporCliente" checked value="Agricultor">--}}
                                    Agricultor
                                </label>
                                {{--<label class="radio-inline">--}}
                                    {{--<input type="radio" name="pagadopor" id="pagadoporMolino" value="Molino">--}}
                                    {{--<label for="pagadoporMolino">Molino</label>--}}
                                {{--</label>--}}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="">Flete x Saco:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">S/</div>
                                    <input type="number" value="0" class="form-control" name="fletexSaco" step="any" min="0" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label for="" class="">Flete x Peso:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">S/</div>
                                        <input type="number" value="0" class="form-control" name="fletexPeso" step="any" min="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Flete x Tonelada:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">S/</div>
                                    <input type="number" value="0" class="form-control" name="fletexTonelada" step="any" min="0" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Flete Total:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">S/</div>
                                    <input type="number" value="0" class="form-control" name="fletexTotal" readonly step="any" min="0">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4" id="grupoChofer">
                                <label for="chofer" class="control-label">Chofer:</label>
                                <div class="">
                                    <input type="text" class=" form-control" name="chofer" value="" readonly>
                                    {{--<select name="chofer" id="chofer" class="form-control" >--}}
                                        {{--<option></option>--}}
                                        {{--@foreach($choferes as $key => $chofer)--}}
                                            {{--<option value="{{$key}}">{{$chofer}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<span class="input-group-btn">--}}
                                        {{--<a href="#" class="btn btn-default" type="button" id="addChofer"><span class="glyphicon glyphicon-plus"></span></a>--}}
                                        {{--<a href="#" class="btn btn-default" type="button" id="reloadChofer" url="{{route('lote.choferes')}}"><span class="glyphicon glyphicon-refresh"></span></a>--}}
                                    {{--</span>--}}
                                </div>
                            </div>
                            <div class="col-md-6" id="grupoVehiculo">
                                <label for="vehiculo" class="control-label">Vehículo:</label>
                                <div class="">
                                    <input type="text" class=" form-control" name="vehiculo" value="" readonly>
                                    {{--<select name="vehiculo" id="vehiculo" class="form-control" >--}}
                                        {{--<option></option>--}}
                                        {{--@foreach($vehiculos as $key => $vehiculo)--}}
                                            {{--<option value="{{$key}}">{{$vehiculo}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<span class="input-group-btn">--}}
                                        {{--<a href="#" class="btn btn-default" type="button" id="addVehiculo"><span class="glyphicon glyphicon-plus"></span></a>--}}
                                        {{--<a href="#" class="btn btn-default" type="button" id="reloadVehiculo" url="{{route('lote.vehiculos')}}"><span class="glyphicon glyphicon-refresh"></span></a>--}}
                                    {{--</span>--}}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="">Nro Sacos % humedad > 13:</label>
                                <input type="number" value="0" class="form-control" name="nro_sacos_mayor_13" min="0" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="">Condición:</label>
                                <input type="text" value="Vacío" class="form-control" readonly name="condicion_mayor_13">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="">Nro Sacos % humedad <= 13:</label>
                                <input type="number" value="0" class="form-control" name="nro_sacos_menor_13" min="0" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="">Condición:</label>
                                <input type="text" value="Vacío" class="form-control" readonly name="condicion_menor_13">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" >Observación:</label>
                                <textarea id="" cols="30" rows="5" class="form-control" name="observacion" readonly></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                {{--<button class="btn btn-success">Registrar</button>--}}
                                {{--<button class="btn btn-default" type="reset" id="limpiar">Limpiar</button>--}}
                                <button class="btn btn-warning " id="index" data-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>
