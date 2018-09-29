<div class="modal fade" tabindex="-1" role="dialog" id="modal-venta-detalle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalle</h4>
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
                                <label for="" class="control-label">Nro. Guía Ingreso a Produccion:</label>
                                <input type="text" value="" class="form-control" readonly name="nro_guia_ingreso">
                                {{--<label for="" class="control-label">Nro. Guía:</label>--}}
                                {{--<input type="text" value="" class="form-control" readonly name="nro_guia">--}}
                            </div>
                            <div class="col-md-3">
                                <label for="" class="control-label">Fecha - Hora Ingreso:</label>
                                <input type="datetime" value="" class="form-control" name="fecha_ingreso" readonly>
                                {{--<label for="" class="control-label">Fecha - Hora:</label>--}}
                                {{--<input type="datetime" value="" class="form-control" name="fecha" readonly>--}}
                            </div>
                            {{--<div class="col-md-4" id="grupoCliente">--}}

                                {{--<div class="" id="agricultorGroup">--}}
                                    {{--<label class="control-label" name="lblCliente">--}}
                                        {{--Agricultor--}}
                                    {{--</label>--}}
                                    {{--<input type="text" class=" form-control" id="clienteAgricultor" value="" readonly>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group" id="grupoVariedad">
                                <label for="" class="control-label">Nro. Guía Recepción:</label>
                                <input type="text" value="" class="form-control" readonly name="nro_guia">
                                {{--<label for="" class="control-label">Variedad de Cáscara:</label>--}}
                                {{--<div class="">--}}
                                    {{--<input type="text" class=" form-control" id="variedad" value="" readonly>--}}
                                {{--</div>--}}
                            </div>
                            <div class="col-md-4">
                                <label for="" class="control-label">Fecha - Hora Recepción:</label>
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
                            {{--<div class="col-md-2">--}}
                                {{--<div class="">--}}
                                    {{--<label for="">Tipo Peso</label>--}}
                                    {{--<div class="center-block" style="">--}}
                                        {{--<label class="radio-inline"  name="lblTipoPeso">--}}
                                            {{--<input type="radio" name="rbtipoPeso" checked id="radioPeso" value="sacos"> --}}
                                            {{--Sacos--}}
                                        {{--</label>--}}
                                        {{--<label class="radio-inline">--}}
                                        {{--<input type="radio" name="rbtipoPeso" id="radioPeso" value="kilos"> Kilos--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="" name="lblPeso2">Kilos:</label>--}}
                                    {{--<input type="number" class="form-control" name="kilos" step="any" min="0" value="0" readonly>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for=""  name="lblPeso3">Peso Real(Kg):</label>--}}
                                    {{--<input type="number" class="form-control" name="pesoreal" readonly step="2" min="0" value="0">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<div class="sacos-grupo">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="" name="lblPeso1">Nro. Sacos</label>--}}
                                            {{--<input type="number" class="form-control" name="nro_sacos" min="0" value="0" readonly >--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                                {{--<label for="" class="control-label">Área de Origen:</label>--}}
                                {{--<input type="text" value="" class="form-control" name="area" readonly>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3" id="grupoVariedad">--}}
                                {{--<label for="" class="control-label">Variedad de Cáscara:</label>--}}
                                {{--<div class="">--}}
                                    {{--<input type="text" class=" form-control" id="variedad" value="" readonly>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="row">
                                <div class="sacos-grupo">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" name="">Nro. Sacos Ingresantes:</label>
                                            <input type="number" class="form-control" name="nro_sacos_ingreso" min="0" value="0" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" name="">Kilos Totales por Sacos:</label>
                                            <input type="number" class="form-control" name="kilos_totales_ingreso" min="0" value="0" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" name="">Área de Origen:</label>
                                            <input type="text" class="form-control" name="area_origen" readonly >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" name="">Variedad de Cáscara:</label>
                                            <input type="text" class=" form-control" id="variedad" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-right">
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