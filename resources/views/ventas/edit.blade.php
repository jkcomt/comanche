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
    <h3 class="text-success text-center">Actualización Exitoso</h3>
@endsection
@section('modal-footer')
    {{--<button class="btn btn-sm btn-primary" id="create-agri">Insertar otro registro</button>--}}
    <a class="btn btn-sm btn-warning"
       href="{{route('ventas.index')}}">Volver</a>
@endsection
{{-----------------------------------------------------------------}}
@section('modal-confirmacion-title')
    <h4 class="modal-title">Aviso</h4>
@endsection
@section('modal-confirmacion-body')
    <h3 class="text-warning text-center">¿Desea registrar la venta?</h3>
@endsection
@section('modal-confirmacion-footer')
    <button class="btn btn-success confirmar" id="">Confirmar</button>
    <a href="" class="btn btn-warning" data-dismiss="modal" id="index" >Volver</a>
@endsection
{{-----------------------------------------------------------------}}
@section('modal')
    {{--@include('clientes.modals.create')--}}
    @include('comprador_persona.modals.create')
    @include('comprador_empresa.modals.create')
@endsection
@section('header','Nueva Venta')
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
            <form action="{{route('ventas.update')}}" id="actualizarVenta">
                <div class="panel panel-default">
                    <div class="panel-heading">INFORMACIÓN DE VENTA</div>
                    <div class="panel-body">

                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="nro_guia_nueva_produccion">Guía Prod:</label>
                                            <input type="text" name="nro_guia_venta" class="form-control"
                                                   readonly
                                                   value="@isset($venta){{$venta->nro_guia_venta}}@else{{"VENT-000001"}}@endisset">
                                            <input type="hidden" value="{{$venta->id}}" name="venta_id">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha">Fecha - Hora:</label>
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="date" value="{{\Carbon\Carbon::parse($venta->fecha_venta)->toDateString()}}"
                                                           class="form-control" name="fecha">
                                                    <input type="time" value="{{\Carbon\Carbon::parse($venta->hora_venta)->toTimeString()}}"
                                                           class="form-control" name="hora">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="grupoCliente">
                                        <div class="radio-inline">
                                            <label for="control-label"><input type="radio" checked name="optradio" value="agricultor" id="rbAgri"> Agricultor</label>
                                        </div>
                                        <div class="radio-inline">
                                            <label for="control-label"><input type="radio" name="optradio" value="empresa" id="rbEmp"> Empresa</label>
                                        </div>
                                        <div class="input-group" id="agricultorGroup">
                                            <select name="agricultor" id="agricultor" class="form-control" >
                                                {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                                <option></option>
                                                @foreach($agricultores as $key => $agricultor)
                                                    <option value="{{$key}}"
                                                        @if($key == $venta->comprador_agricultor_id)
                                                            selected="selected"
                                                        @endif
                                                    >{{$agricultor}}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addAgricultor"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadAgricultor" url="{{route('ventas.agricultores')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                        </div>
                                        <div class="input-group" id="empresaGroup">
                                            <select name="empresa" id="empresa" class="form-control" >
                                                {{--<input type="text" class=" form-control" name="personal" value="{{old('personal')}}">--}}
                                                <option></option>
                                                @foreach($empresas as $key => $empresa)
                                                    <option value="{{$key}}"
                                                            @if($key == $venta->comprador_empresa_id)
                                                            selected="selected"
                                                            @endif
                                                    >{{$empresa}}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                        <a href="#" class="btn btn-primary" type="button" id="addEmpresa"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a href="#" class="btn btn-warning" type="button" id="reloadEmpresa" url="{{route('ventas.empresas')}}"><span class="glyphicon glyphicon-refresh"></span></a>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipo_comprobante">Comprobante:</label>
                                            <input type="text" value="{{$venta->tipo_comprobante}}" readonly class="form-control">
                                            {{--<input type="text" name="nro_guia_nueva_produccion" class="form-control"--}}
                                                   {{--readonly--}}
                                                   {{--value="@isset($nuevaProduccion){{$nuevaProduccion->generarSerieGuia()}}@else{{"SAL-000001"}}@endisset">--}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="serie_comprobante">Nro. Comprobante:</label>
                                            <input type="text" name="serie_comprobante" class="form-control"
                                                   readonly
                                                   value="@if($venta->tipo_comprobante == "BOLETA"){{$venta->nro_boleta}}@elseif($venta->tipo_comprobante == "FACTURA"){{$venta->nro_factura}}@elseif($venta->tipo_comprobante == "TICKET"){{$venta->nro_ticket}}@endif">
                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Producto</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="producto">Descrip. Producto</label>
                                        <select name="producto" id="producto" class="form-control input-sm">
                                            <option value="">SELECCIONE UN PRODUCTO</option>
                                            @foreach($productos as $producto)
                                                <option value="{{$producto->id}}">{{$producto->descripcion_producto}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="nro_sacos">Cant. Stock</label>
                                        <input type="number" class="form-control input-sm" name="cantidad_stock" value="0" readonly>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="sacos_kilos">Kilos</label>
                                        <input type="number" class="form-control input-sm" name="sacos_kilos" value="0" step="any" readonly>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="precio_maquila">Precio</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">S/</div>
                                            <input type="number" readonly class="form-control input-sm" name="precio" value="0" step="any">
                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="cantidad">Cant. Comprar</label>
                                        <input type="number" class="form-control input-sm" name="cantidad" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-block" name="add">
                                    <h4><span class="fa fa-plus-circle"></span></h4>
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
                                <th>COD. PRODUCTO</th>
                                <th>DESCRIPCIÓN DE PRODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>KILOS</th>
                                <th>PRECIO</th>
                                <th>TOTAL</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="" class="label-control">SUB TOTAL</label>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-addon">S/</div>
                                    <input type="text" class="form-control input-sm" name="sub_total" value="{{number_format(($venta->total - $venta->igv),2)}}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="" class="label-control">IGV</label>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-addon">S/</div>
                                <input type="text" class="form-control input-sm" name="igv" value="{{number_format($venta->igv,2)}}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="" class="label-control">TOTAL</label>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="input-group-addon">S/</div>
                                    <input type="text" class="form-control input-sm" name="total" value="{{$venta->total}}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="" class="label-control">OBSERVACIÓN</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control input-sm" name="observacion" class="form-control" value="{{$venta->observacion}}"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label for="" class="label-control">SON:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control input-sm" name="monto_descripcion" class="form-control" value="{{$venta->monto_descripcion}}"/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success actualizarVenta" type="button">Actualizar</button>
                                <a href="{{route('ventas.index')}}"
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
    <script src="{{asset('js/ventas.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection