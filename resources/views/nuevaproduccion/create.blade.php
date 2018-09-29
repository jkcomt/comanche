@extends('layout')
@section('api')
    @include('apis.select2')
    <style>
        .vertical-align {
            display: flex;
            align-items: center;
        }
    </style>
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
    <a class="btn btn-sm btn-warning"
       href="{{route('nuevaproduccion.index',['id'=>$ingresoProduccion->id])}}">Volver</a>
@endsection
{{-----------------------------------------------------------------}}
@section('modal')
    {{--@include('responsables.modals.create')--}}
@endsection
@section('header','Nueva Producción')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div id="msg-error" class="alert alert-danger" style="display:none;">
                <strong>Corriga los campos indicados por favor.</strong>
                <ul>
                    <div id="listaerrores">
                    </div>
                </ul>
            </div>
            <form action="{{route('nuevaproduccion.create')}}" id="registrarSalidaProduccion">
            <div class="panel panel-default">
                <div class="panel-heading">INFORMACIÓN DE INGRESO A PRODUCCIÓN</div>
                <div class="panel-body">

                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nro_guia_nueva_produccion">Guía Prod:</label>
                                            <input type="text" name="nro_guia_prod" class="form-control"
                                                   readonly
                                                   value="{{$ingresoProduccion->nro_guia_ingreso}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nro_guia_nueva_produccion">Fecha- Hora Ingreso:</label>
                                            <input type="text" name="fecha_ingreso_produccion" class="form-control"
                                                   readonly
                                                   value="{{$ingresoProduccion->fecha.' '.$ingresoProduccion->hora}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="ingreso_produccion_id"
                                               value="{{($ingresoProduccion->id)}}">
                                        <div class="form-group">
                                            <label for="nro_guia_nueva_produccion">Nro. Guía de Salida:</label>
                                            <input type="text" name="nro_guia_nueva_produccion" class="form-control"
                                                   readonly
                                                   value="@isset($nuevaProduccion){{$nuevaProduccion->generarSerieGuia()}}@else{{"SAL-000001"}}@endisset">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="fecha">Fecha - Hora:</label>
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <input type="date" value="{{\Carbon\Carbon::now()->toDateString()}}"
                                                       class="form-control" name="fecha">
                                                <input type="time" value="{{\Carbon\Carbon::now()->toTimeString()}}"
                                                       class="form-control" name="hora">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nro_campana">Campaña:</label>
                                            <input type="text" name="nro_campana" class="form-control" readonly
                                                   value="{{$ingresoProduccion->lote->compania}}">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="variedad">Variedad Cáscara:</label>
                                            <input type="text" name="variedad" class="form-control" readonly
                                                   value="{{$ingresoProduccion->lote->variedad->descripcion}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="origen">Área de Origen:</label>
                                            <input type="text" name="origen" class="form-control" readonly
                                                   value="{{$ingresoProduccion->area_origen}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Kilos por saco:</label>
                                        <input type="text" name="" value="{{$ingresoProduccion->kilo_por_saco}}" class="form-control" readonly>
                                    </div>
                                </div>
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<label for="">Kilos por saco:</label>--}}
                                        {{--<input type="text" name="" value="{{$ingresoProduccion->kilo_por_saco}}" class="form-control" readonly>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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
                                                                   name="nro_sacos_stock_inicial" value="{{$ingresoProduccion->nro_sacos_ingresados - $ingresoProduccion->nuevaProduccion->where('estado','Habilitado')->sum('nro_sacos_a_procesar')}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Kilos Totales Stock Inicial:</label>
                                                            <div class="input-group">
                                                            <input type="number" step="any" value="{{($ingresoProduccion->nro_sacos_ingresados - $ingresoProduccion->nuevaProduccion->where('estado','Habilitado')->sum('nro_sacos_a_procesar')) * $ingresoProduccion->kilo_por_saco}}"
                                                                   name="kilos_totales_stock_inicial"
                                                                   class="form-control" readonly>
                                                            <input type="hidden" value="{{$ingresoProduccion->kilo_por_saco}}" name="kilo_por_sacos">
                                                            <span class="input-group-addon">Kg</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nro_sacos_procesar" class="control-label">Nro
                                                                Sacos a procesar:</label>
                                                                <input type="number" step="any" value="0"
                                                                       name="nro_sacos_procesar" class="form-control"
                                                                       min="0" max="{{$ingresoProduccion->nro_sacos_ingresados}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="kilos_sacos_procesar">Kilos a procesar:</label>
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

            <div class="panel panel-default">
                <div class="panel-heading">Resultados de Producción</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="producto">Descrip. Producto</label>
                                        <select name="producto" id="" class="form-control input-sm">
                                            <option value="" selected>Arroz Añejo</option>
                                            <option value="">Arroz Extra</option>
                                            <option value="">Arroz Clasificado</option>
                                            <option value="">Arroz Despuntado</option>
                                            <option value="">Arroz Superior</option>
                                            <option value="">Arroz Casserita</option>
                                            <option value="">Descarte</option>
                                            <option value="">Arrocillo 1/2</option>
                                            <option value="">Arrocillo 3/4</option>
                                            <option value="">Ñelen</option>
                                            <option value="">Polvillo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="nro_sacos">N° Sacos</label>
                                        <input type="number" class="form-control input-sm" name="nro_sacos" value="0">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="sacos_kilos">Kilos</label>
                                        <input type="number" class="form-control input-sm" name="sacos_kilos" value="0" step="any">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="precio_maquila">Precio Maquila</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" class="form-control input-sm" name="precio_maquila" value="0" step="any">
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="sub_total_maquila">Sub total Maquila</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" step="any" class="form-control input-sm" name="sub_total_maquila" value="0" readonly>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 form-group">
                                        <label for="nro_envases">N° Envases</label>
                                        <input type="number" class="form-control input-sm" name="nro_envases" value="0">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="envase">Descrip. Envase</label>
                                        <select name="envase" id="" class="form-control input-sm">
                                            <option value="" selected>Arroz Añejo</option>
                                            <option value="">Arroz Extra</option>
                                            <option value="">Arroz Clasificado</option>
                                            <option value="">Arroz Despuntado</option>
                                            <option value="">Arroz Superior</option>
                                            <option value="">Arroz Casserita</option>
                                            <option value="">Descarte</option>
                                            <option value="">Arrocillo 1/2</option>
                                            <option value="">Arrocillo 3/4</option>
                                            <option value="">Ñelen</option>
                                            <option value="">Polvillo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="precio_envase">Precio Envase</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" step="any" class="form-control input-sm" name="precio_envase" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="sub_total_envases">Sub total Envases</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" step="any" class="form-control input-sm" name="sub_total_envases" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="sub_total_envases">Cobro Adicional</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" step="any" class="form-control input-sm" name="cobro_adicional" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="sub_total_adicional">Sub Total Adicional</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" step="any" class="form-control input-sm" name="sub_total_adicional" value="0" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-block" style="margin-top:20px;" name="add">
                                    <h1><span class="fa fa-plus-circle"></span></h1>
                                    <span>AÑADIR</span>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
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
                            <th rowspan="2">OPCIONES</th>
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
                            <p><label for="" name="produccion">S/ 0.00</label></p>
                            <p><label for="" name="envases">S/ 0.00</label></p>
                            <p><label for="" name="adicional">S/ 0.00</label></p>
                            <p><label for="" name="total">S/ 0.00</label></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success" type="submit">Registrar</button>
                            <a href="{{route('nuevaproduccion.index',['id'=>$ingresoProduccion->id])}}"
                               class="btn btn-warning">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/nuevaproduccion.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
