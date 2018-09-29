<div class="modal fade" tabindex="-1" role="dialog" id="modal-nuevaproduccion-detalle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detalle Producción</h4>
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
                            <form action="" id="detalleSalidaProduccion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">INFORMACIÓN DE INGRESO A PRODUCCIÓN</div>
                                    <div class="panel-body">

                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nro_guia_nueva_produccion">Nro. Guía de Producción:</label>
                                                            <input type="text" name="nro_guia_produccion" class="form-control"
                                                                   readonly
                                                                   value="{{$ingresoProduccion->nro_guia_ingreso}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="fecha_hora_produccion">Fecha-Hora de Producción:</label>
                                                            <input type="text" name="fecha_hora_produccion" class="form-control"
                                                                   readonly
                                                                   value="{{$ingresoProduccion->fecha.'-'.Carbon\Carbon::parse($ingresoProduccion->hora)->format('H:i:s A')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="fecha_hora_produccion">Kilos por saco (Recepción):</label>
                                                            <input type="text" name="fecha_hora_produccion" class="form-control"
                                                                   readonly
                                                                   value="{{$ingresoProduccion->lote->kilos}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input type="hidden" name="ingreso_produccion_id"
                                                               value="{{($ingresoProduccion->id)}}">
                                                        <div class="form-group">
                                                            <label for="nro_guia_nueva_produccion">Nro. Guía de Salida:</label>
                                                            <input type="text" name="nro_guia_nueva_produccion" class="form-control"
                                                                   readonly
                                                                   value="">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label for="fecha">Fecha - Hora:</label>
                                                        <div class="form-inline">
                                                            <div class="form-group">
                                                                <input type="input" value=""
                                                                       class="form-control" name="fecha" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="input" value=""
                                                                       class="form-control" name="hora" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nro_campana">Campaña:</label>
                                                            <input type="text" name="nro_campana" class="form-control" readonly
                                                                   value="{{($ingresoProduccion->lote->compania)}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        @isset($ingresoProduccion->lote->agricultor)
                                                            <label for="agricultor">Agricultor :</label>
                                                            <input type="text" name="agricultor" class="form-control" readonly
                                                                   value="{{$ingresoProduccion->lote->agricultor->apellidos.' '.$ingresoProduccion->lote->agricultor->nombres}}">
                                                            @else
                                                                <label for="empresa">Empresa :</label>
                                                                <input type="text" name="empresa" class="form-control" readonly
                                                                       value="{{$ingresoProduccion->lote->empresa->razon_social}}">
                                                                @endisset
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="variedad">Variedad de Cáscara:</label>
                                                            <input type="text" name="variedad" class="form-control" readonly
                                                                   value="{{$ingresoProduccion->lote->variedad->descripcion}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="origen">Área de Origen:</label>
                                                            <input type="text" name="origen" class="form-control" readonly
                                                            value="{{$ingresoProduccion->area_origen}}">
                                                            {{--<input type="text" name="origen" class="form-control" readonly--}}
                                                                   {{--value="{{$ingresoProduccion->lote->procedencia->lugar}}">--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-md-6"><strong>N° Sacos</strong></div>
                                                            <div class="col-md-6"><strong>N° Kilos</strong></div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Nro. Sacos Stock Inicial:</label>
                                                                            <input type="number" class="form-control"
                                                                                   name="nro_sacos_stock_inicial" value="" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Kilos Totales Stock Inicial:</label>
                                                                            <div class="input-group">
                                                                                <input type="number" step="any" value=""
                                                                                       name="kilos_totales_stock_inicial"
                                                                                       class="form-control" readonly>
                                                                                <input type="hidden" value="" name="kilo_por_sacos">
                                                                                <span class="input-group-addon">Kg</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="nro_sacos_procesar" class="control-label">Nro
                                                                                Sacos por procesar:</label>
                                                                            <input type="number" step="any" value="0"
                                                                                   name="nro_sacos_procesar" class="form-control"
                                                                                   min="0" max="" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="kilos_sacos_procesar">Kilos por procesar:</label>
                                                                            <div class="input-group">
                                                                                <input type="number" step="any" value="0"
                                                                                       name="kilos_sacos_procesar" class="form-control"
                                                                                       min="0" readonly>
                                                                                <span class="input-group-addon">Kg</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="nro_sacos_saldo">Nro Sacos Saldo:</label>
                                                                            <input type="number" value="0"
                                                                                   name="nro_sacos_saldo" class="form-control" min="0"
                                                                                   readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="kilos_sacos_saldo">Kilos :</label>
                                                                            <div class="input-group">
                                                                                <input type="number" step="any" value="0"
                                                                                       name="kilos_sacos_saldo" class="form-control" min="0"
                                                                                       readonly>
                                                                                <span class="input-group-addon">Kg</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="panel-heading">RESULTADO DE PRODUCCION</div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-responsive table-hover table-condensed small box text-center " id="tabla">
                                            <thead >
                                            <tr>
                                                <th rowspan="2">PRODUCTO</th>
                                                <th rowspan="2">N° SACOS</th>
                                                <th rowspan="2">KILOS</th>
                                                <th rowspan="2">PRECIO MAQUILA</th>
                                                <th rowspan="2">N° ENVASES</th>
                                                <th rowspan="2">ENVASES</th>
                                                <th rowspan="2">PRECIO ENVASE</th>
                                                <th colspan="3" >SUB TOTAL</th>
                                                {{--<th rowspan="2">OPCIONES</th>--}}
                                            </tr>
                                            <tr>
                                                <th>MAQUILA</th>
                                                <th>ENVASES</th>
                                                <th>ADICIONAL</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p><label for="">PRODUCCIÓN (MAQUILA)</label></p>
                                                <p><label for="">ENVASES</label></p>
                                                <p><label for="">ADICIONAL</label></p>
                                                <p><label for="">TOTAL A FAVOR DEL MOLINO</label></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><label for="" name="produccion">0.00</label></p>
                                                <p><label for="" name="envases">0.00</label></p>
                                                <p><label for="" name="adicional">0.00</label></p>
                                                <p><label for="" name="total">0.00</label></p>
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