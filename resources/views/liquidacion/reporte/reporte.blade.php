
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sistema Comanche</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{asset('css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
{{--<link href="{{asset('css/dashboard.css')}}" rel="stylesheet">--}}

{{--<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">--}}

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{{asset('js/ie8-responsive-file-warning.js')}}"></script><![endif]-->
    <script src="{{asset('js/ie-emulation-modes-warning.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body{
            font-size: 12px;
        }
        .center-text{
            text-align: center;
        }
        .padding-top{
            padding-top: 30px;
            border: hidden;
        }

    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <table>
            <tr>
                <td style="padding-right: 100px">
                    <h5>MOLINO EL COMANCHE S.R.L.</h5>
                    <h5>Carretera Panamericana Norte Km. 690 Centro Poblado Menor San Martín de Porres – San José – Provincia de Pacasmayo – La Libertad.</h5>
                    <h5>RUC: 20482126112  |  Cel: 972620212  |  Teléfono:044-498067</h5>
                </td >
                <td>
                    {{--<td style="margin-left:50px;padding-left: 150px">--}}
                    <img src="{{asset('img/logo.jpg')}}" alt="" width="120px" height="100px">
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="text-center">
        <h3 style="margin-top:5px;">DOCUMENTO DE LIQUIDACION</h3>
    </div>
    <div class="">
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Campaña</td>
                    <td>Nro. Guía</td>
                    <td>Fecha - Hora</td>
                    <td>
                        @if(!empty($liquidacion->lote->agricultor))
                            Agricultor
                        @elseif(!empty($liquidacion->lote->cliente))
                            Cliente
                        @else
                            Empresa
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        {{$liquidacion->lote->compania}}
                    </td>
                    <td>{{$liquidacion->lote->nro_guia}}
                    </td>
                    <td>
                        {{$liquidacion->lote->fecha.' '.Carbon\Carbon::parse($liquidacion->lote->hora)->format('H:i:s A')}}
                    </td>
                    <td>
                        @if(!empty($liquidacion->lote->agricultor))
                            {{$liquidacion->lote->agricultor->apellidos.' '.$liquidacion->lote->agricultor->nombres}}
                        @elseif(!empty($liquidacion->lote->cliente))
                            {{$liquidacion->lote->cliente->apellidos.' '.$liquidacion->lote->cliente->nombres}}
                        @else
                            {{$liquidacion->lote->empresa->razon_social}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Variedad de cáscara</td>
                    {{--<td>Tipo peso</td>--}}
                    <td>
                        @if($liquidacion->lote->tipo_peso == 'sacos')
                            Kilos
                        @elseif($liquidacion->lote->tipo_peso == 'kilos')
                            Nro. Sacos
                        @endif
                    </td>
                    <td>
                        @if($liquidacion->lote->tipo_peso == 'sacos')
                            Nro. Sacos
                        @elseif($liquidacion->lote->tipo_peso == 'kilos')
                            Peso Real(Kg)
                        @endif
                    </td>

                    <td>
                        @if($liquidacion->lote->tipo_peso == 'sacos')
                            Peso Real(Kg)
                        @elseif($liquidacion->lote->tipo_peso == 'kilos')
                            Kilos
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>
                        {{$liquidacion->lote->variedad->descripcion}}
                    </td>
                    <td>
                        @if($liquidacion->lote->tipo_peso == 'sacos')
                            {{$liquidacion->lote->nro_sacos}}
                        @elseif($liquidacion->lote->tipo_peso == 'kilos')
                            {{$liquidacion->lote->peso_real}}
                        @endif
                    </td>
                    {{--<td>--}}
                        {{--{{ucfirst($liquidacion->lote->tipo_peso)}}--}}
                    {{--</td>--}}

                    <td>
                        @if($liquidacion->lote->tipo_peso == 'sacos')
                            {{$liquidacion->lote->kilos}}
                        @elseif($liquidacion->lote->tipo_peso == 'kilos')
                            {{$liquidacion->lote->nro_sacos}}
                        @endif
                    </td>
                    <td>
                        @if($liquidacion->lote->tipo_peso == 'sacos')
                            {{$liquidacion->lote->peso_real}}
                        @elseif($liquidacion->lote->tipo_peso == 'kilos')
                            {{$liquidacion->lote->kilos}}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Origen</td>
                    <td>Tipo flete</td>
                    <td>
                        Pagado por
                    </td>
                </tr>
                <tr>
                    <td>
                        {{$liquidacion->lote->procedencia->lugar}}
                    </td>
                    <td>
                        @if($liquidacion->lote->tipo_flete == 'fletePeso')
                            Peso
                        @elseif($liquidacion->lote->tipo_flete == 'fleteSaco')
                            Saco
                        @elseif($liquidacion->lote->tipo_flete == 'fleteTonelada')
                            Tonelada
                        @endif
                    </td>
                    <td>
                        {{ucfirst($liquidacion->lote->pagado_por)}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Chofer</td>
                    <td>Vehículo</td>
                </tr>
                <tr>
                    <td>
                        {{$liquidacion->lote->chofer->apellidos.' '.$liquidacion->lote->chofer->nombres}}
                    </td>
                    <td>
                        {{$liquidacion->lote->vehiculo->marca.' '.$liquidacion->lote->vehiculo->descripcion.' '.$liquidacion->lote->vehiculo->placa}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Nro Sacos % humedad mayor a 13 </td>
                    <td>Condición</td>
                </tr>
                <tr>
                    <td>
                        {{$liquidacion->lote->nro_humedad_mayor_13}}
                    </td>
                    <td>
                        @if($liquidacion->lote->nro_humedad_mayor_13 > 0) Secado @else Vacío @endif
                    </td>
                </tr>

            </table>
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Nro Sacos % humedad menor e igual a 13 </td>
                    <td>Condición</td>
                </tr>
                <tr>
                    <td>
                        {{$liquidacion->lote->nro_humedad_menor_13}}
                    </td>
                    <td>
                        @if($liquidacion->lote->nro_humedad_menor_13 > 0) Producción @else Vacío @endif
                    </td>
                </tr>
            </table>
        </div>
        @if($liquidacion->lote->loteSecado)
            <h5>INFORMACIÓN DE SECADO</h5>
            <table class="table table-condensed table-bordered">
                <tr>
                    <td><strong>Nro Sacos Entrantes:</strong></td>
                    <td><strong>Nro Sacos Secos:</strong></td>
                    <td><strong>Nro Pérdida de Sacos :</strong></td>
                    <td><strong>Importe Total de Transferencia a Almacen:</strong></td>
                </tr>
                <tr>
                    <td>{{$liquidacion->lote->loteSecado->lote->nro_humedad_mayor_13}}</td>
                    <td>{{$liquidacion->lote->loteSecado->sumtatotalnrosacosrecogidos()}}</td>
                    <td>
                        <?php $resultado = 0;
                        $resultado1 = 0;
                        $kilosperdidos = 0;
                        ?>
                        @foreach($liquidacion->lote->loteSecado->tendido->where('estado','Habilitado') as $tendido)
                            @php
                                $resultado += ($tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos'));
                                $resultado1 += ($tendido->nro_sacos_a_secar);
                            @endphp
                        @endforeach
                        {{$resultado1 - $resultado}}
                    </td>
                    <td class="text-right">
                        <?php $resultado = 0;
                        ?>
                        @if($liquidacion->lote->loteSecado)
                        @foreach($liquidacion->lote->loteSecado->tendido->where('estado','Habilitado') as $tendido)
                            @php
                                $resultado += ($tendido->totalImporteAlmacen());
                            @endphp
                        @endforeach
                            @endif
                        {{number_format($resultado,2)}}
                    </td>
                </tr>
            </table>
        @endif

        <h5>INFORMACIÓN DE PRODUCCION</h5>

        @foreach($liquidacion->lote->produccionIngreso as $produccionIngreso)
            <div>
                <table class="table table-condensed table-bordered">
                    <tr>
                        <td colspan="5"><strong>N° GUIA PRODUCCIÓN</strong></td>
                        <td colspan="6">{{$produccionIngreso->nro_guia_ingreso}}</td>
                    </tr>

                {{--</table>--}}

                    @foreach($produccionIngreso->nuevaProduccion as $nuevaProduccion)
                        <tr>
                            <td colspan="5"><strong>N° GUÍA SALIDA</strong></td>
                            <td colspan="6">
                                {{$nuevaProduccion->nro_guia_salida}}
                            </td>
                        </tr>

                {{--</table>--}}
                {{--<h5>RESULTADO DE PRODUCCIÓN</h5>--}}
                {{--<table class="table table-condensed table-bordered">--}}
                    <tr rowspan="2">
                        <td rowspan="2"><strong>PRODUCTO</strong></td>
                        <td rowspan="2"><strong>N° SACOS</strong></td>
                        <td rowspan="2"><strong>KILOS</strong></td>
                        <td rowspan="2"><strong>PRECIO MAQUILA</strong></td>
                        <td rowspan="2"><strong>N° ENVASES</strong></td>
                        <td rowspan="2"><strong>ENVASES</strong></td>
                        <td rowspan="2"><strong>PRECIO ENVASE</strong></td>
                        <td rowspan="2"><strong>ADICIONAL X SACO</strong></td>
                        <td colspan="3"><strong>SUB TOTAL</strong></td>

                    </tr>
                    <tr>
                        <td><strong>MAQUILA</strong></td>
                        <td><strong>ENVASES</strong></td>
                        <td><strong>ADICIONAL</strong></td>
                    </tr>
                    @foreach($nuevaProduccion->resultadoProduccion as $resultadoProduccion)

                        <tr>
                            <td>{{$resultadoProduccion->producto}}</td>
                            <td>{{$resultadoProduccion->nro_sacos}}</td>
                            <td>{{$resultadoProduccion->kilos}}</td>
                            <td>{{$resultadoProduccion->precio_maquila}}</td>
                            <td>{{$resultadoProduccion->nro_envases}}</td>
                            <td>{{$resultadoProduccion->envase}}</td>
                            <td>{{$resultadoProduccion->precio_envase}}</td>
                            <td>{{number_format($resultadoProduccion->sub_total_adicional/$resultadoProduccion->nro_sacos,2)}}</td>
                            <td>{{$resultadoProduccion->sub_total_maquila}}</td>
                            <td>{{$resultadoProduccion->sub_total_envase}}</td>
                            <td>{{$resultadoProduccion->sub_total_adicional}}</td>
                        </tr>

                    @endforeach
                    {{--<table class="table table-condensed table-bordered">--}}
                        <tr>
                            <td colspan="8"><strong>PRODUCCIÓN (MAQUILA)</strong></td>
                            <td colspan="3">S/ {{$nuevaProduccion->resultadoProduccion->sum('sub_total_maquila')}}</td>
                        </tr>
                        <tr>
                            <td colspan="8"><strong>ENVASES</strong></td>
                            <td colspan="3">S/ {{$nuevaProduccion->resultadoProduccion->sum('sub_total_envase')}}</td>
                        </tr>
                        <tr>
                            <td colspan="8"><strong>ADICIONAL</strong></td>
                            <td colspan="3">S/ {{$nuevaProduccion->resultadoProduccion->sum('sub_total_adicional')}}</td>
                        </tr>
                        <tr>
                            <td colspan="8"><strong>TOTAL A FAVOR DEL MOLINO</strong></td>
                            <td colspan="3">S/ {{$nuevaProduccion->resultadoProduccion->sum('sub_total_maquila') + $nuevaProduccion->resultadoProduccion->sum('sub_total_envase')+ $nuevaProduccion->resultadoProduccion->sum('sub_total_adicional')}}</td>
                        </tr>
                    {{--</table>--}}

                @endforeach
                </table>
            </div>
        @endforeach
        <br>
        <h5>INFORMACIÓN DE VENTAS</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>PRODUCTO</strong></td>
                <td><strong>CANTIDAD</strong></td>
                <td><strong>KILOS</strong></td>
                <td><strong>PRECIO</strong></td>
                <td><strong>TOTAL</strong></td>
            </tr>
                @foreach($detalleVentas as $detalleVenta)

                    <tr>
                        <td>{{$detalleVenta->descripcion_producto}}</td>
                        <td>{{$detalleVenta->cantidad}}</td>
                        <td>{{$detalleVenta->kilos}}</td>
                        <td>{{$detalleVenta->precio}}</td>
                        <td>{{$detalleVenta->total}}</td>
                    </tr>

                @endforeach
            @php
             $suma = 0;
            @endphp
            @foreach($liquidacion->lote->stockResultadoProduccion as $stockResultadoProduccion)
                @foreach($stockResultadoProduccion->DetalleVenta as $detalleVenta)
                  {{$suma += ($detalleVenta->cantidad * $detalleVenta->precio)}}
                 @endforeach
             @endforeach
            <tr>
                <td colspan="4" class="text-right"><strong>INCLUYE IGV</strong></td>
                <td>{{number_format($suma,2)}}</td>
            </tr>
        </table>
        <h5>LIQUIDACIÓN</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>VENTAS</strong></td><td>{{number_format($suma,2)}}</td>
            </tr>
            <tr>
                @if($liquidacion->lote->pagado_por == "agricultor" || $liquidacion->lote->pagado_por == "empresa")
                    <td><strong>PRESTAMO DEL MOLINO</strong></td><td>0.00</td>
                @else
                    <td><strong>PRESTAMO DEL MOLINO</strong></td><td>{{number_format($liquidacion->lote->flete_total,2)}}</td>
                @endif
            </tr>
            <tr>
                @php
                    $sumaAlmacen = 0;
                    $sumaMolino = 0;
                @endphp
                @if($liquidacion->lote->loteSecado)
                @foreach($liquidacion->lote->loteSecado->tendido as $tendido)
                    @foreach($tendido->recojo as $recojo)
                        {{$sumaAlmacen += $recojo->importe_sacos}}
                    @endforeach
                @endforeach
                @endif
                <td><strong>COBROS TRANSFERENCIA</strong></td><td>{{number_format($sumaAlmacen,2)}}</td>
                @foreach($liquidacion->lote->produccionIngreso as $produccionIngreso)
                    @foreach($produccionIngreso->nuevaProduccion as $nuevaProduccion)
                        @foreach($nuevaProduccion->resultadoProduccion as $resultadoProduccion)
                            {{$sumaMolino += $resultadoProduccion->sub_total_maquila + $resultadoProduccion->sub_total_envase + $resultadoProduccion->sub_total_adicional}}
                        @endforeach
                    @endforeach
                @endforeach

            </tr>
            <tr>
                <td><strong>A FAVOR DEL MOLINO</strong></td>
                <td>{{number_format($sumaMolino,2)}}</td>
            </tr>
            <tr>
                <td><strong>TOTAL</strong></td>
                @if($liquidacion->lote->pagado_por == "agricultor" || $liquidacion->lote->pagado_por == "empresa")
                    <td>{{number_format($suma-0-$sumaAlmacen-$sumaMolino,2)}}</td>
                @else
                    <td>{{number_format($suma-$liquidacion->lote->flete_total-$sumaAlmacen-$sumaMolino,2)}}</td>
                @endif

            </tr>
        </table>
        <table class="table padding-top">
            <tr class="center-text" >
                <td>
                    <b>___________________________________</b><br>
                    <b>Administrador</b><br>
                    {{--<b>{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}}</b>--}}
                </td>
                <td>
                </td>
                <td>
                    <b>___________________________________</b><br>
                    @if(!empty($liquidacion->lote->agricultor))
                        <b>Agricultor :</b>
                        <b>{{$liquidacion->lote->agricultor->apellidos.' '.$liquidacion->lote->agricultor->nombres}}</b><br>
                        <b>
                            @isset($liquidacion->lote->agricultor->dni)
                                DNI: {{$liquidacion->lote->agricultor->dni}}
                                @else
                                    RUC: {{$liquidacion->lote->agricultor->ruc}}
                                    @endisset
                        </b>
                    @elseif(!empty($liquidacion->lote->cliente))
                        <b>Cliente :</b>
                        <b>{{$liquidacion->lote->cliente->apellidos.' '.$liquidacion->lote->cliente->nombres}}</b><br>
                        <b>{{$liquidacion->lote->cliente->dni}}</b>
                    @elseif(!empty($liquidacion->lote->empresa))
                        <b>Representante : {{$liquidacion->lote->empresa->representante}}</b><br>
                        <b>          DNI : {{$liquidacion->lote->empresa->dni_representante}}</b>

                    @endif
                </td>
            </tr>

        </table>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<!-- Latest compiled and minified JavaScript -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="{{asset('js/holder.min.js')}}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>
