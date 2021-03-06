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
        <h3 style="margin-top: 5px;">DOCUMENTO DE TENDIDO</h3>
    </div>
    <div class="">
        <h5>INFORMACIÓN DE LOTE</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Campaña</strong></td>
                <td><strong>Fecha - Hora</strong></td>
                <td><strong>Nro. Guía de Secado:</strong></td>
                @if(!empty($tendido->loteSecado->lote->agricultor))
                    <td><strong>Agricultor:</strong></td>
                @elseif(!empty($tendido->loteSecado->lote->cliente))
                    <td><strong>Cliente:</strong></td>
                @elseif(!empty($tendido->loteSecado->lote->empresa))
                    <td><strong>Empresa:</strong></td>
                @endif
            </tr>
            <tr>
                <td>{{$tendido->loteSecado->lote->compania}}</td>
                <td>{{$tendido->loteSecado->fecha.' '.Carbon\Carbon::parse($tendido->loteSecado->hora)->format('H:i:s A')}}</td>
                <td>{{$tendido->loteSecado->nro_serie_guia}}</td>
                @if(!empty($tendido->loteSecado->lote->agricultor))
                    <td>{{$tendido->loteSecado->lote->agricultor->apellidos.' '.$tendido->loteSecado->lote->agricultor->nombres}}</td>
                @elseif(!empty($tendido->loteSecado->lote->cliente))
                    <td>{{$tendido->loteSecado->lote->cliente->apellidos.' '.$tendido->loteSecado->lote->cliente->nombres}}</td>
                @elseif(!empty($tendido->loteSecado->lote->empresa))
                    <td>{{$tendido->loteSecado->lote->empresa->razon_social}}</td>
                @endif
            </tr>
        </table>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Variedad:</strong></td>
                <td><strong>Tipo Peso:</strong></td>
                @if($tendido->loteSecado->lote->tipo_peso == 'kilos')
                    <td><strong>Peso Real:</strong></td>
                    <td><strong>Nro. Sacos:</strong></td>
                    <td><strong>Kilos:</strong></td>
                @else
                    <td><strong>Nro. Sacos:</strong></td>
                    <td><strong>Kilos:</strong></td>
                    <td><strong>Peso Real:</strong></td>
                @endif
            </tr>
            <tr>
                <td>{{$tendido->loteSecado->lote->variedad->descripcion}}</td>
                @if($tendido->loteSecado->lote->tipo_peso == 'kilos')
                    <td>{{ucfirst($tendido->loteSecado->lote->tipo_peso)}}</td>
                    <td>{{$tendido->loteSecado->lote->peso_real}}</td>
                    <td>{{$tendido->loteSecado->lote->nro_sacos}}</td>
                    <td>{{$tendido->loteSecado->lote->kilos}}</td>
                @else
                    <td>{{ucfirst($tendido->loteSecado->lote->tipo_peso)}}</td>
                    <td>{{$tendido->loteSecado->lote->nro_sacos}}</td>
                    <td>{{$tendido->loteSecado->lote->kilos}}</td>
                    <td>{{$tendido->loteSecado->lote->peso_real}}</td>
                @endif
            </tr>
        </table>
        <h5>INFORMACIÓN DE SECADO</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Nro Guía de Tendido:</strong></td>
                <td><strong>Fecha - Hora:</strong></td>
                <td><strong>Responsable de cuadrilla:</strong></td>
            </tr>
            <tr>
                <td>{{$tendido->nro_guia_tendido}}</td>
                <td>{{$tendido->fecha.' '.Carbon\Carbon::parse($tendido->hora)->format('H:i:s A')}}</td>
                <td>{{$tendido->responsable->apellidos.' '.$tendido->responsable->nombres}}</td>
            </tr>
        </table>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Nro sacos por secar:</strong> </td><td>{{$tendido->nro_sacos_pre_secado}}</td>
                <td><strong>Kilos por secar:</strong> </td><td>{{$tendido->kilos_pre_secado}}</td>
            </tr>
            <tr>
                <td><strong>Nro sacos a secar: </strong></td><td>{{$tendido->nro_sacos_a_secar}}</td>
                <td><strong>Kilos a secar:</strong></td><td> {{$tendido->kilos_a_secar}}</td>
            </tr>
            <tr>
                <td><strong>Nro sacos restantes:</strong> </td><td>{{$tendido->nro_sacos_no_secado}}</td>
                <td><strong>Kilos restantes:</strong></td><td>{{$tendido->kilos_no_secado}}</td>
            </tr>
            <tr >
                <td colspan="4"><strong>Observación:</strong></td>
            </tr>
            <tr>
                <td colspan="4">{{$tendido->observacion}}</td>
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
