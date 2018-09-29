
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
        <h3 style="margin-top: 5px;">DOCUMENTO DE RECEPCIÓN</h3>
    </div>
    <div class="">
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                <td>Campaña</td>
                <td>Nro. Guía</td>
                <td>Fecha - Hora</td>
                <td>
                @if(!empty($lote->agricultor))
                    Agricultor
                @else
                    Empresa
                @endif
                </td>
                </tr>
                <tr>
                    <td>
                    {{$lote->compania}}
                    </td>
                    <td>{{$lote->nro_guia}}
                    </td>
                    <td>
                       {{$lote->fecha.' '.Carbon\Carbon::parse($lote->hora)->format('H:i:s A')}}
                    </td>
                    <td>
                       @if(!empty($lote->agricultor))
                           {{$lote->agricultor->apellidos.' '.$lote->agricultor->nombres}}
                       @else
                           {{$lote->empresa->razon_social}}
                       @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                  <td>Variedad de cáscara</td>
                   <td>Tipo peso</td>
                   <td>
                    @if($lote->tipo_peso == 'sacos')
                       Nro. Sacos
                    @elseif($lote->tipo_peso == 'kilos')
                       Peso Real(Kg)
                    @endif
                    </td>
                    <td>
                      @if($lote->tipo_peso == 'sacos')
                        Kilos
                      @elseif($lote->tipo_peso == 'kilos')
                        Nro. Sacos
                      @endif
                    </td>
                    <td>
                      @if($lote->tipo_peso == 'sacos')
                        Peso Real(Kg)
                      @elseif($lote->tipo_peso == 'kilos')
                         Kilos
                      @endif
                     </td>
                    </tr>
                    <tr>
                        <td>
                            {{$lote->variedad->descripcion}}
                        </td>
                        <td>
                            {{ucfirst($lote->tipo_peso)}}
                        </td>
                        <td>
                            @if($lote->tipo_peso == 'sacos')
                                {{$lote->nro_sacos}}
                            @elseif($lote->tipo_peso == 'kilos')
                                {{$lote->peso_real}}
                            @endif
                        </td>
                        <td>
                            @if($lote->tipo_peso == 'sacos')
                                {{$lote->kilos}}
                            @elseif($lote->tipo_peso == 'kilos')
                                {{$lote->nro_sacos}}
                            @endif
                        </td>
                        <td>
                            @if($lote->tipo_peso == 'sacos')
                                {{$lote->peso_real}}
                            @elseif($lote->tipo_peso == 'kilos')
                                {{$lote->kilos}}
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
                        {{$lote->procedencia->lugar}}
                    </td>
                    <td>
                        @if($lote->tipo_flete == 'fletePeso')
                            Peso
                        @elseif($lote->tipo_flete == 'fleteSaco')
                            Saco
                        @elseif($lote->tipo_flete == 'fleteTonelada')
                            Tonelada
                        @endif
                    </td>
                    <td>
                        {{ucfirst($lote->pagado_por)}}
                    </td>
                </tr>
            </table>
        </div>
        <div class="">
            <table class="table table-condensed table-bordered">
                <tr>
                    <td>Flete x Saco</td>
                    <td>Flete x Peso</td>
                    <td>Flete x Tonelada</td>
                    <td>Flete Total</td>
                </tr>
                <tr>
                    <td>
                       S/ {{$lote->flete_x_saco}}
                    </td>
                    <td>
                       S/ {{$lote->flete_x_peso}}
                    </td>
                    <td>
                       S/  {{$lote->flete_x_tonelada}}
                    </td>
                    <td>
                       S/  {{$lote->flete_total}}
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
                        {{$lote->chofer->apellidos.' '.$lote->chofer->nombres}}
                    </td>
                    <td>
                        {{$lote->vehiculo->marca.' '.$lote->vehiculo->descripcion.' '.$lote->vehiculo->placa}}
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
                        {{$lote->nro_humedad_mayor_13}}
                    </td>
                    <td>
                        @if($lote->nro_humedad_mayor_13 > 0) Secado @else Vacío @endif
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
                        {{$lote->nro_humedad_menor_13}}
                    </td>
                    <td>
                        @if($lote->nro_humedad_menor_13 > 0) Producción @else Vacío @endif
                    </td>
                </tr>
            </table>
        </div>
        <table class="table table-condensed table-bordered">
            <tr>
            <td >Observación:</td>
            </tr>
            <tr>
                <td style="font-size: 9px;">{{$lote->observacion}}</td>
            </tr>
        </table>
        <table class="table padding-top">
            <tr class="center-text" >
                <td>
                <b>___________________________________</b><br>
                <b>Jefe de Recepción</b><br>
                <b>{{auth()->user()->personal->apellidos.' '.auth()->user()->personal->nombres}}</b>
                </td>
                <td>
                </td>
                <td>
                    <b>___________________________________</b><br>
                    @if(!empty($lote->agricultor))
                        <b>Agricultor :</b>
                        <b>{{$lote->agricultor->apellidos.' '.$lote->agricultor->nombres}}</b><br>
                        <b>
                            @isset($lote->agricultor->dni)
                                DNI: {{$lote->agricultor->dni}}
                            @else
                                RUC: {{$lote->agricultor->ruc}}
                            @endisset
                        </b>
                    @elseif(!empty($lote->empresa))
                        <b>Representante : {{$lote->empresa->representante}}</b><br>
                        <b>          DNI : {{$lote->empresa->dni_representante}}</b>
                        {{--<b>Empresa :</b>--}}
                        {{--<b>{{$lote->empresa->razon_social}}</b><br>--}}
                        {{--<b>{{$lote->empresa->ruc}}</b>                        --}}
                    @endif
                </td>
            </tr>
            {{--<tr class="">--}}
                {{----}}
            {{--</tr>--}}

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
