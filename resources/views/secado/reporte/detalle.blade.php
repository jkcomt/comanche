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
        <h3 style="margin-top: 5px;">DOCUMENTO DE SECADO</h3>
    </div>
    <div class="">
        <h5>INFORMACIÓN DE LOTE</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Campaña</strong></td>
                <td><strong>Nro. Guía de Secado:</strong></td>
                @if(!empty($loteSecado->lote->agricultor))
                    <td><strong>Agricultor:</strong></td>
                @elseif(!empty($loteSecado->lote->cliente))
                    <td><strong>Cliente:</strong></td>
                @elseif(!empty($loteSecado->lote->empresa))
                    <td><strong>Empresa:</strong></td>
                @endif
            </tr>
            <tr>
                <td>{{$loteSecado->lote->compania}}</td>
                <td>{{$loteSecado->nro_serie_guia}}</td>
                @if(!empty($loteSecado->lote->agricultor))
                    <td>{{$loteSecado->lote->agricultor->apellidos.' '.$loteSecado->lote->agricultor->nombres}}</td>

                @elseif(!empty($loteSecado->lote->cliente))
                    <td>{{$loteSecado->lote->cliente->apellidos.' '.$loteSecado->lote->cliente->nombres}}</td>

                @elseif(!empty($loteSecado->lote->empresa))
                    <td>{{$loteSecado->lote->empresa->razon_social}}</td>
                @endif
            </tr>
        </table>
        <h5>INFORMACIÓN DE SECADO</h5>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Nro Sacos Entrantes:</strong></td>
                <td><strong>Nro Sacos Secos:</strong></td>
                <td><strong>Nro Pérdida de Sacos :</strong></td>
            </tr>
            <tr>
                <td>{{$loteSecado->lote->nro_humedad_mayor_13}}</td>
                <td>{{$loteSecado->sumtatotalnrosacosrecogidos()}}</td>
                <td>
                    <?php $resultado = 0;
                    $resultado1 = 0;
                    $kilosperdidos = 0;
                    ?>
                @foreach($loteSecado->tendido->where('estado','Habilitado') as $tendido)
                    @php
                        $resultado += ($tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos'));
                        $resultado1 += ($tendido->nro_sacos_a_secar);
                    @endphp
                @endforeach
                {{$resultado1 - $resultado}}
                </td>

            </tr>
        </table>
        <table class="table table-condensed table-bordered">
            <tr>
                <td><strong>Kg Totales de Sacos Entrantes:</strong></td>
                <td><strong>Kg Totales de Sacos Secos:</strong></td>
                <td><strong>Kg Totales de Pérdida de Sacos:</strong></td>
            </tr>
            <tr>
                <td>{{$loteSecado->lote->nro_humedad_mayor_13 * $loteSecado->lote->kilos}}</td>
                <td>{{$loteSecado->sumtatotalkilossacosrecogidos()}}</td>
                <td>
                    {{($resultado1 - $resultado) * $loteSecado->lote->kilos}}
                </td>

            </tr>
        </table>
        <h5>TENDIDOS</h5>
        <table class="table table-condensed table-bordered" style="font-size: 10px;">
            <tr>
                <th>N. Guía</th>
                <th>Fecha</th>
                <th>Responsable</th>
                <th>N. Sacos Tendidos</th>
                <th>N. Sacos No Secados</th>
                <th>N. Sacos Perdidos</th>
            </tr>
            <tbody>
            @foreach($loteSecado->tendido->sortBy('fecha') as $tendido)
                @if($tendido->estado == "Habilitado")
                <tr>
                    <td>{{$tendido->nro_guia_tendido}}</td>
                    <td>{{Carbon\Carbon::parse($tendido->fecha)->format('d/m/y')}} {{Carbon\Carbon::parse($tendido->hora)->format('H:i A')}}</td>
                    <td>{{$tendido->responsable->apellidos.' '.$tendido->responsable->nombres}}</td>
                    <td>{{$tendido->nro_sacos_a_secar}}</td>
                    <td>{{$tendido->nro_sacos_no_secado}}</td>
                    <td>@if($tendido->recojo->last())@if($tendido->recojo->last()->nro_sacos_no_recogidos == 0){{$tendido->nro_sacos_a_secar - $tendido->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos')}}@endif @else 0 @endif</td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <h5>RECOJOS</h5>
        <table class="table table-condensed table-bordered" style="font-size: 10px;">
            <tr>
                <th>N° Guía</th>
                <th>Fecha</th>
                <th>Nro Sacos Recogidos</th>
                <th>Kg Recogido</th>
                <th>Peso Recogido</th>
                <th>Nro Sacos No Recogidos</th>
                <th>KG No Recogidos</th>
                <th>Peso No Recogido</th>
            </tr>
            <tbody>
            @foreach($loteSecado->tendido->sortBy('fecha') as $tendido)
                @foreach($tendido->recojo->sortBy('fecha') as $recojo)
                    @if($recojo->estado == "Habilitado")
                        <tr>
                            <td>{{$recojo->nro_guia_recojo}}</td>
                            <td>{{Carbon\Carbon::parse($recojo->fecha)->format('d/m/y')}} {{Carbon\Carbon::parse($recojo->hora)->format('H:i A')}}</td>
                            <td>{{$recojo->nro_sacos_recogidos}}</td>
                            <td>{{$recojo->kilos_recogidos}}</td>
                            <td>{{$recojo->peso_recogidos}}</td>
                            <td>{{$recojo->nro_sacos_no_recogidos}}</td>
                            <td>{{$recojo->kilos_no_recogidos}}</td>
                            <td>{{$recojo->peso_no_recogido}}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
        <div style="position: absolute;bottom:0;">
            <table class="table padding-top">
                <tr class="center-text" >
                    <td>
                        <b>___________________________________</b><br>
                        <b>Jefe de Secado</b><br>
                        <b>{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}} |</b>
                        <b>{{'DNI: '.auth()->user()->personal->dni}}</b>
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        </div>
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
