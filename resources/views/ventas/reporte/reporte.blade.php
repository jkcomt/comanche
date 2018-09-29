
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
        <h3 style="margin-top:5px;">DOCUMENTO DE VENTAS</h3>
    </div>
    <div class="">
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td><label for="">Guía Prod:</label></td>
                    <td><label for="">Fecha - Hora</label></td>
                    @if($venta->tipo_cliente == "persona")
                        <td><label for="">Persona</label></td>
                    @elseif($venta->tipo_cliente == "empresa")
                        <td><label for="">Empresa</label></td>
                    @endif

                </tr>
                <tr>
                    <td>{{$venta->nro_guia_venta}}</td>
                    <td>{{\Carbon\Carbon::parse($venta->fecha_venta)->toDateString().' '.\Carbon\Carbon::parse($venta->hora_venta)->toTimeString()}}</td>
                    @if($venta->tipo_cliente == "persona")
                        <td>{{$venta->compradorPersona->apellidos.' '.$venta->compradorPersona->nombres}}</td>
                        @elseif($venta->tipo_cliente == "empresa")
                        <td>{{$venta->compradorEmpresa->razon_social}}</td>
                    @endif
                </tr>
            </table>
            <table class="table table-condensed table-bordered">
                <tr>
                    <td><label for="">Comprobante:</label></td>
                    <td><label for="">Nro. Comprobante</label></td>
                </tr>
                <tr>
                    <td>{{$venta->tipo_comprobante}}</td>
                    @if($venta->tipo_comprobante == "BOLETA")
                        <td>{{$venta->nro_boleta}}</td>
                    @elseif($venta->tipo_comprobante == "FACTURA")
                        <td>{{$venta->nro_factura}}</td>
                    @elseif($venta->tipo_comprobante == "TICKET")
                        <td>{{$venta->nro_ticket}}</td>
                    @endif
                </tr>
            </table>
        </div>

        <hr>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><label for="">COD. PRODUCTO:</label></td>
                <td><label for="">DESCRIPCION PRODUCTO</label></td>
                <td><label for="">CANTIDAD</label></td>
                <td><label for="">KILOS</label></td>
                <td><label for="">PRECIO</label></td>
                <td><label for="">TOTAL</label></td>
            </tr>
            @foreach($detalleVentas as $detalleVenta)
                <tr>
                    <td>{{$detalleVenta->stock_producto_id}}</td>
                    <td>{{$detalleVenta->descripcion_producto}}</td>
                    <td>{{$detalleVenta->cantidad}}</td>
                    <td>{{$detalleVenta->kilos}}</td>
                    <td>{{$detalleVenta->precio}}</td>
                    <td>{{($detalleVenta->precio * $detalleVenta->cantidad)}}</td>
                </tr>
             @endforeach
        </table>

        <table class="table table-condensed table-bordered">
            <tr>
                <td><label for="">SUB TOTAL:</label></td><td>{{number_format($venta->total - $venta->igv,2)}}</td>
            </tr>
            <tr>
                <td><label for="">IGV</label></td><td>{{$venta->igv}}</td>
            </tr>
            <tr>
                <td><label for="">TOTAL</label></td><td>{{$venta->total}}</td>
            </tr>
            <tr>
                <td><label for="">OBSERVACIÓN</label></td><td>{{$venta->observacion}}</td>
            </tr>
            <tr>
                <td><label for="">SON:</label></td><td>{{$venta->monto_descripcion}}</td>
            </tr>
        </table>


        {{--<div style="position: absolute;bottom:0;">--}}
            {{--<table class="table padding-top">--}}
                {{--<tr class="center-text" >--}}
                    {{--<td>--}}
                        {{--<b>___________________________________</b><br>--}}
                        {{--<b>Jefe de Producción</b><br>--}}
                        {{--<b>{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}} |</b>--}}
                        {{--<b>{{'DNI: '.auth()->user()->personal->dni}}</b>--}}
                    {{--</td>--}}
                    {{--<td>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</div>--}}
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
