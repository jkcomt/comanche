
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
        <h3 style="margin-top:5px;">DOCUMENTO DE PRODUCCIÓN</h3>
    </div>
    <div class="">
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Nro. Guía Producción</td>
                    <td>Fecha - Hora Ing:</td>
                    {{--<td>Área de Origen:</td>--}}
                </tr>
                <tr>
                    <td>
                        {{$produccionIngreso->nro_guia_ingreso}}
                    </td>
                    <td>
                        {{$produccionIngreso->fecha.' '.Carbon\Carbon::parse($produccionIngreso->hora)->format('H:i A')}}
                    </td>
                    {{--<td>--}}
                        {{--{{$produccionIngreso->area_origen}}--}}
                    {{--</td>--}}
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Campaña</td>
                    <td>
                        @if(!empty($lote->agricultor))
                            Agricultor
                        @else
                            Empresa
                        @endif
                    </td>
                    <td>Variedad de cáscara</td>
                    <td>Área de Origen:</td>
                    <td>
                        @if($lote->tipo_peso == 'sacos')
                            Kilos
                        @elseif($lote->tipo_peso == 'kilos')
                            Nro. Sacos
                        @endif
                    </td>
                    {{--<td>Nro. Guía</td>--}}
                    {{--<td>Fecha - Hora Recepción</td>--}}
                </tr>
                <tr>
                    <td>
                    {{$lote->compania}}
                    </td>
                    <td>
                        @if(!empty($lote->agricultor))
                            {{$lote->agricultor->apellidos.' '.$lote->agricultor->nombres}}
                        @else
                            {{$lote->empresa->razon_social}}
                        @endif
                    </td>
                    <td>
                        {{$lote->variedad->descripcion}}
                    </td>
                    <td>
                    {{$produccionIngreso->area_origen}}
                    </td>
                    <td>
                        @if($lote->tipo_peso == 'sacos')
                            {{$lote->kilos}}
                        @elseif($lote->tipo_peso == 'kilos')
                            {{$lote->nro_sacos}}
                        @endif
                    </td>
                    {{--<td>{{$lote->nro_guia}}</td>--}}
                    {{--<td>--}}
                       {{--{{$lote->fecha.' '.Carbon\Carbon::parse($lote->hora)->format('H:i A')}}--}}
                    {{--</td>--}}

                </tr>
            </table>
        </div>
        {{--<hr>--}}
        @foreach($produccionIngreso->nuevaProduccion as $nuevoIngreso)
            @if($nuevoIngreso->estado == "Habilitado")
                <h5>INFORMACIÓN DE INGRESO A PRODUCCIÓN</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <td colspan="2"><strong>Nro. Guía de Salida:</strong></td>
                            <td colspan="2"> {{$nuevoIngreso->nro_guia_salida}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Fecha - Hora:</strong></td>
                            <td colspan="2">
                                {{$nuevoIngreso->fecha.' '.Carbon\Carbon::parse($nuevoIngreso->hora)->format('H:i A')}}
                            </td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td><strong>Campaña</strong></td>--}}
                            {{--<td>{{$nuevoIngreso->ingresoProduccion->lote->compania}}</td>--}}

                            {{--<td>--}}
                                {{--@if(!empty($nuevoIngreso->ingresoProduccion->lote->agricultor))--}}
                                    {{--<strong> Agricultor</strong>--}}
                                {{--@else--}}
                                    {{--<strong>Empresa</strong>--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--@if(!empty($nuevoIngreso->ingresoProduccion->lote->agricultor))--}}
                                    {{--{{$nuevoIngreso->ingresoProduccion->lote->agricultor->apellidos.' '.$nuevoIngreso->ingresoProduccion->lote->agricultor->nombres}}--}}
                                {{--@else--}}
                                    {{--{{$nuevoIngreso->ingresoProduccion->lote->empresa->razon_social}}--}}
                                {{--@endif--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td><strong>Variedad</strong></td>--}}
                            {{--<td>{{$nuevoIngreso->ingresoProduccion->lote->variedad->descripcion}}</td>--}}
                            {{--<td><strong>Origen</strong></td>--}}
                            {{--<td>{{$nuevoIngreso->ingresoProduccion->lote->procedencia->lugar}}</td>--}}
                        {{--</tr>--}}
                    </table>
                </td>
                <td>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <td colspan="2"><strong>N° Sacos</strong></td>
                            <td colspan="2"><strong>N° Kilos</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Nro. Sacos Stock Inicial:</strong></td>
                            <td>{{$nuevoIngreso->nro_sacos_stock_inicial}}</td>
                            <td><strong>Kilos Totales Stock Inicial:</strong></td>
                            <td>{{$nuevoIngreso->kilos_total_inicial}}</td>
                        </tr>
                        <tr>
                            <td><strong>Nro. Sacos por procesar:</strong></td>
                            <td>{{$nuevoIngreso->nro_sacos_a_procesar}}</td>
                            <td><strong>Kilos por procesar:</strong></td>
                            <td>{{$nuevoIngreso->kilos_a_procesar}}</td>
                        </tr>
                        <tr>
                            <td><strong>Nro. Sacos Saldo:</strong></td>
                            <td>{{$nuevoIngreso->nro_sacos_saldo}}</td>
                            <td><strong>Kilos Saldo:</strong></td>
                            <td>{{$nuevoIngreso->kilos_total_saldo}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

            <h5>RESULTADO DE PRODUCCIÓN</h5>
            <table class="table table-condensed table-bordered" style="font-size: 10px;">
                <tr>
                    <th rowspan="2">PRODUCTO</th>
                    <th rowspan="2">N° SACOS</th>
                    <th rowspan="2">KILOS</th>
                    <th rowspan="2">PRECIO MAQUILA</th>
                    <th rowspan="2">N° ENVASES</th>
                    <th rowspan="2">ENVASES</th>
                    <th rowspan="2">PRECIO ENVASE</th>
                    <th rowspan="2">ADICIONAL X SACO</th>
                    <th colspan="3">SUB TOTAL</th>
                </tr>
                <tr>
                    <th>MAQUILA</th>
                    <th>ENVASES</th>
                    <th>ADICIONAL</th>
                </tr>
                <tbody>
                @foreach($nuevoIngreso->resultadoProduccion as $resultado)
                    @if($resultado->estado = 'Habilitado')
                        <tr>
                            <td>{{$resultado->producto}}</td>
                            <td>{{$resultado->nro_sacos}}</td>
                            <td>{{$resultado->kilos}}</td>
                            <td>{{$resultado->precio_maquila}}</td>
                            <td>{{$resultado->nro_envases}}</td>
                            <td>{{$resultado->envase}}</td>
                            <td>{{$resultado->precio_envase}}</td>
                            <td>{{number_format($resultado->sub_total_adicional/$resultado->nro_sacos,2)}}</td>
                            <td>S/ {{$resultado->sub_total_maquila}}</td>
                            <td>S/ {{$resultado->sub_total_envase}}</td>
                            <td>S/ {{$resultado->sub_total_adicional}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <table class="table table-condensed table-bordered">
                <tr>
                    <td><strong>PRODUCCIÓN (MAQUILA)</strong></td>
                    <td>S/ {{$nuevoIngreso->resultadoProduccion->sum('sub_total_maquila')}}</td>
                </tr>
                <tr>
                    <td><strong>ENVASES</strong></td>
                    <td>S/ {{$nuevoIngreso->resultadoProduccion->sum('sub_total_envase')}}</td>
                </tr>
                <tr>
                    <td><strong>TOTAL A FAVOR DEL MOLINO</strong></td>
                    <td>S/ {{$nuevoIngreso->resultadoProduccion->sum('sub_total_maquila') + $nuevoIngreso->resultadoProduccion->sum('sub_total_envase')}}</td>
                </tr>
            </table>
            <hr>
            @endif
        @endforeach
        {{--<div class="">--}}
            {{--<table class="table table-condensed table-bordered">--}}
                {{--<tr>--}}
                  {{--<td>Variedad de cáscara</td>--}}
                   {{--<td>Tipo peso</td>--}}
                   {{--<td>--}}
                    {{--@if($lote->tipo_peso == 'sacos')--}}
                       {{--Nro. Sacos--}}
                    {{--@elseif($lote->tipo_peso == 'kilos')--}}
                       {{--Peso Real(Kg)--}}
                    {{--@endif--}}
                    {{--</td>--}}
                    {{--<td>--}}
                      {{--@if($lote->tipo_peso == 'sacos')--}}
                        {{--Kilos--}}
                      {{--@elseif($lote->tipo_peso == 'kilos')--}}
                        {{--Nro. Sacos--}}
                      {{--@endif--}}
                    {{--</td>--}}
                    {{--<td>--}}
                      {{--@if($lote->tipo_peso == 'sacos')--}}
                        {{--Peso Real(Kg)--}}
                      {{--@elseif($lote->tipo_peso == 'kilos')--}}
                         {{--Kilos--}}
                      {{--@endif--}}
                     {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td>--}}
                            {{--{{$lote->variedad->descripcion}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ucfirst($lote->tipo_peso)}}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--@if($lote->tipo_peso == 'sacos')--}}
                                {{--{{$lote->nro_sacos}}--}}
                            {{--@elseif($lote->tipo_peso == 'kilos')--}}
                                {{--{{$lote->peso_real}}--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--@if($lote->tipo_peso == 'sacos')--}}
                                {{--{{$lote->kilos}}--}}
                            {{--@elseif($lote->tipo_peso == 'kilos')--}}
                                {{--{{$lote->nro_sacos}}--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--@if($lote->tipo_peso == 'sacos')--}}
                                {{--{{$lote->peso_real}}--}}
                            {{--@elseif($lote->tipo_peso == 'kilos')--}}
                                {{--{{$lote->kilos}}--}}
                            {{--@endif--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--</table>--}}
        {{--</div>--}}

        <div style="position: absolute;bottom:0;">
            <table class="table padding-top">
                <tr class="center-text" >
                    <td>
                        <b>___________________________________</b><br>
                        <b>Jefe de Producción</b><br>
                        <b>{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}} |</b>
                        <b>{{'DNI: '.auth()->user()->personal->dni}}</b>
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        </div>
        {{--<table class="table padding-top">--}}
            {{--<tr class="center-text" >--}}
                {{--<td >--}}
                {{--<b>___________________________________</b><br>--}}
                {{--<b>Jefe de Recepción</b><br>--}}
                {{--<b>{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}}</b>--}}
                {{--</td>--}}
                {{--<td>--}}

                {{--</td>--}}
                {{--<td>--}}
                    {{--<b>___________________________________</b><br>--}}
                    {{--@if(!empty($lote->agricultor))--}}
                        {{--<b>Agricultor :</b>--}}
                        {{--<b>{{$lote->agricultor->apellidos.' '.$lote->agricultor->nombres}}</b><br>--}}
                        {{--<b>{{$lote->agricultor->dni}}</b>--}}
                    {{--@elseif(!empty($lote->empresa))--}}
                        {{--<b>Representante : {{$lote->empresa->representante}}</b><br>--}}
                        {{--<b>          DNI : {{$lote->empresa->dni_representante}}</b>--}}
                        {{--<b>Empresa :</b>--}}
                        {{--<b>{{$lote->empresa->razon_social}}</b><br>--}}
                        {{--<b>{{$lote->empresa->ruc}}</b>                        --}}
                    {{--@endif--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--</table>--}}
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
