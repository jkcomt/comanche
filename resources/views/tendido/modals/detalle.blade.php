<div class="modal fade" tabindex="-1" role="dialog" id="modal-tendido-detalle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalle Tendido</h4>
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
                        </div>
                        <div class="">
                            <form action="" id="detalleTendido">
                                <div class="panel panel-default">
                                    <div class="panel-heading">INFORMACIÓN DE RECEPCIÓN DE LOTES INGRESANTES</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="">
                                                <div class="col-md-2 form-group">
                                                    <label for="">Campaña:</label>
                                                    <input type="text" name="campana" class="form-control input-sm" value="" readonly>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label for="">Fecha - Hora:</label>
                                                    <input type="text" name="fecha_lote" class="form-control input-sm" value="" readonly>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label for="">Nro. Guía de Ingreso:</label>
                                                    <input type="text" name="guia_lote" class="form-control input-sm" value="" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    @if(!empty($loteSecado->lote->agricultor))
                                                        <label for="">Agricultor:</label>
                                                        <input type="text" class="form-control input-sm" value="{{$loteSecado->lote->agricultor->apellidos.' '.$loteSecado->lote->agricultor->nombres}}" readonly>
                                                    @elseif(!empty($loteSecado->lote->cliente))
                                                        <label for="">Cliente</label>
                                                        <input type="text" class="form-control input-sm" value="{{$loteSecado->lote->cliente->apellidos.' '.$loteSecado->lote->cliente->nombres}}" readonly>
                                                    @elseif(!empty($loteSecado->lote->empresa))
                                                        <label for="">Empresa</label>
                                                        <input type="text" class="form-control input-sm" value="{{$loteSecado->lote->empresa->razon_social}}" readonly>
                                                    @endif
                                                    {{--<label for="cliente_lote">Agricultor:</label>--}}
                                                    {{--<input type="text" class="form-control input-sm" name="cliente_lote" readonly>--}}
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
                                                    <input type="text" class="form-control input-sm" name="sacos_lote" value="{{$loteSecado->lote->nro_sacos}}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Kilos:</label>
                                                    <input type="text" name="lote_kilos" class="form-control input-sm" value="{{$loteSecado->lote->kilos}}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Peso Real:</label>
                                                    <input type="text" name="peso_real_lote" class="form-control input-sm" value="{{$loteSecado->lote->peso_real}}" readonly>
                                                </div>

                                            @elseif($loteSecado->lote->tipo_peso == 'kilos')
                                                <div class="col-md-2">
                                                    <label for="">Peso Real (Kg):</label>
                                                    <input type="text" name="" class="form-control input-sm" value="{{$loteSecado->lote->peso_real}}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Nro. Sacos:</label>
                                                    <input type="text" name="" class="form-control input-sm" value="{{$loteSecado->lote->nro_sacos}}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">Kilos:</label>
                                                    <input type="text" name="lote_kilos" class="form-control input-sm" value="{{$loteSecado->lote->kilos}}" readonly>
                                                </div>
                                            @endif
                                            <div class="col-md-3">
                                                <label for="">Variedad:</label>
                                                <input type="text" name="variedad_lote" class="form-control input-sm" value="{{$loteSecado->lote->variedad->descripcion}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           <div class="panel panel-default">
                            <div class="panel-heading">INFORMACIÓN DE TENDIDO</div>
                              <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="lote_secado" value="{{($loteSecado->id)}}">
                                        <label for="nro_guia_tendido" >Nro. Guía de Tendido:</label>
                                        <input type="text" name="nro_guia_tendido" class="form-control input-sm" readonly value="">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fecha">Fecha - Hora:</label>
                                        <input name="fecha_tendido" type="text" class="form-control input-sm" value="" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="responsable" class="control-label">Responsable de cuadrilla:</label>
                                        <div class="" id="responsableGroup">
                                            <input type="text" class="form-control input-sm" name="responsable" value="" readonly>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Nro Sacos Por Secar:</label>
                                                <input type="text" class="form-control input-sm" name="sacos_pendientes" value="" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Kilos Por Secar:</label>
                                                <input type="number" step="any" value="0" name="kilos_pendientes" class="form-control input-sm" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="sacos_secar" class="control-label">Nro Sacos a Secar:</label>
                                                <input type="number" step="any" value="0" name="sacos_secar" class="form-control input-sm" min="0" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="kilos_secar">Kilos a Secar:</label>
                                                <input type="number" step="any" value="0" name="kilos_secar" class="form-control input-sm" min="0" max="200" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="sacos_restantes">Nro Sacos Restantes:</label>
                                                <input type="number" step="any" value="0" name="sacos_restantes" class="form-control input-sm" min="0" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="kilos_restantes">Kilos Restantes:</label>
                                                <input type="number" step="any" value="0" name="kilos_restantes" class="form-control input-sm" min="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Observación:</label>
                                        <textarea name="observacion" id="" cols="30" rows="11" class="form-control input-sm" readonly></textarea>
                                    </div>
                                </div>
                              </div>
                           </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-warning" data-dismiss="modal"> Volver</button>
            </div>
        </div>
    </div>
</div>