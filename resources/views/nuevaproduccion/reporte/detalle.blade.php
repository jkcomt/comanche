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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{asset('css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    {{--<link href="{{asset('css/dashboard.css')}}" rel="stylesheet">--}}

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
        <h3 style="margin-top: 5px;">DOCUMENTO DE SALIDAS DE PRODUCCIÓN</h3>
    </div>
    <div class="">
        <h5>INFORMACIÓN DE INGRESO A PRODUCCIÓN</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <td colspan="2"><strong>Nro. Guía Prod:</strong></td>
                            <td colspan="2"> {{$nuevoIngreso->ingresoProduccion->nro_guia_ingreso}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Fecha- Hora Ingreso:</strong></td>
                            <td colspan="2"> {{$nuevoIngreso->ingresoProduccion->fecha}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Nro. Guía de Salida:</strong></td>
                            <td colspan="2"> {{$nuevoIngreso->nro_guia_salida}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Fecha - Hora Salida:</strong></td>
                            <td colspan="2">
                                {{$nuevoIngreso->fecha.' '.Carbon\Carbon::parse($nuevoIngreso->hora)->format('H:i A')}}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Campaña</strong></td>
                            <td>{{$nuevoIngreso->ingresoProduccion->lote->compania}}</td>

                            <td>
                                @if(!empty($nuevoIngreso->ingresoProduccion->lote->agricultor))
                                   <strong> Agricultor</strong>
                                @else
                                    <strong>Empresa</strong>
                                @endif
                            </td>
                            <td>
                                @if(!empty($nuevoIngreso->ingresoProduccion->lote->agricultor))
                                    {{$nuevoIngreso->ingresoProduccion->lote->agricultor->apellidos.' '.$nuevoIngreso->ingresoProduccion->lote->agricultor->nombres}}
                                @else
                                    {{$nuevoIngreso->ingresoProduccion->lote->empresa->razon_social}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Variedad de Cáscara</strong></td>
                            <td>{{$nuevoIngreso->ingresoProduccion->lote->variedad->descripcion}}</td>
                            <td><strong>Área de Origen</strong></td>
                            <td>{{$nuevoIngreso->ingresoProduccion->area_origen}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Kilos por saco</strong></td>
                            <td colspan="2">{{$nuevoIngreso->ingresoProduccion->kilo_por_saco}}</td>
                        </tr>
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
                            <td><strong>Nro. Sacos a procesar:</strong></td>
                            <td>{{$nuevoIngreso->nro_sacos_a_procesar}}</td>
                            <td><strong>Kilos a procesar:</strong></td>
                            <td>{{$nuevoIngreso->kilos_a_procesar}}</td>
                        </tr>
                        <tr>
                            <td><strong>Nro. Sacos Saldo :</strong></td>
                            <td>{{$nuevoIngreso->nro_sacos_saldo}}</td>
                            <td><strong>Kilos Saldo:</strong></td>
                            <td>{{$nuevoIngreso->kilos_total_saldo}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <h5>RESULTADO PRODUCCIÓN</h5>
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
                <th colspan="3" >SUB TOTAL</th>
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
                    <td>{{number_format($resultado->sub_total_adicional / $resultado->nro_sacos,2)}}</td>
                    <td>S/ {{$resultado->sub_total_maquila}}</td>
                    <td>S/ {{$resultado->sub_total_envase}}</td>
                    <td>S/ {{$resultado->sub_total_adicional}}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <div>
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
                <td><strong>ADICIONAL</strong></td>
                <td>S/ {{$nuevoIngreso->resultadoProduccion->sum('sub_total_adicional')}}</td>
            </tr>
            <tr>
                <td><strong>TOTAL A FAVOR DEL MOLINO</strong></td>
                <td>S/ {{$nuevoIngreso->resultadoProduccion->sum('sub_total_maquila') + $nuevoIngreso->resultadoProduccion->sum('sub_total_envase')+ $nuevoIngreso->resultadoProduccion->sum('sub_total_adicional')}}</td>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
<script src="{{asset('js/holder.min.js')}}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>
</html>
