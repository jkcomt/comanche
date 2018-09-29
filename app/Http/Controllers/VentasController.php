<?php

namespace App\Http\Controllers;

use App\CompradorEmpresa;
use App\CompradorPersona;
use App\Ventas;
use App\DetalleVenta;
use App\StockProductoItem;
use App\StockResultadoProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use View;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Ventas::where('estado','Habilitado')->paginate(10);

        return view('ventas.index',compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venta = Ventas::where('estado','=','Habilitado')->get()->last();

        $agricultores = CompradorPersona::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('nombres_completos','id')->toArray();

        $empresas =CompradorEmpresa::select(DB::raw("razon_social"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('razon_social','id')->toArray();

        $productos = StockProductoItem::where('estado','Habilitado')->get();

        //dd($productos->first->StockResultadoProduccion);
        return view('ventas.create',compact('venta','agricultores','empresas','productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $items = null;
        $cantidadSolicitada = 0;
        $cantidadComprada = 0;
        if(request()->ajax()){
            $items = request()->items;

            $data = request()->validate([
               'nro_guia_venta'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'optradio'=>'required',
                'agricultor'=>'nullable',
                'empresa'=>'nullable',
                'tipo_comprobante'=>'required',
                'serie_comprobante'=>'required',
                'sub_total'=>'required',
                'igv'=>'required',
                'total'=>'required',
                'observacion'=>'required',
                'monto_descripcion'=>'required'
            ]);

            $tipoComprobante = null;
            $nroBoleta = null;
            $nroFactura = null;
            $nroTicket = null;
            if($data['tipo_comprobante'] == "BOLETA"){
                $nroBoleta = $data['serie_comprobante'];
            }else if($data['tipo_comprobante'] == "FACTURA"){
                $nroFactura = $data['serie_comprobante'];
            }else if($data['tipo_comprobante'] == "TICKET"){
                $nroTicket = $data['serie_comprobante'];
            }

            $venta = Ventas::create([
               'nro_guia_venta'=>$data['nro_guia_venta'],
                'fecha_venta'=>$data['fecha'],
                'hora_venta'=>$data['hora'],
                'tipo_cliente'=>$data['optradio'],
                'comprador_persona_id'=>isset($data['agricultor'])? $data['agricultor']:null,
                'comprador_empresa_id'=>isset($data['empresa'])? $data['empresa']:null,
                'tipo_comprobante'=>$data['tipo_comprobante'],
                'nro_boleta'=>$nroBoleta,
                'nro_factura'=>$nroFactura,
                'nro_ticket'=>$nroTicket,
                'igv'=>$data['igv'],
                'total'=>$data['total'],
                'observacion'=>$data['observacion'],
                'monto_descripcion'=>$data['monto_descripcion'],
                'fecha_registro'=>Carbon::now(),
                'estado'=>'Habilitado'
            ]);

            //dd(request()->all());
            for ($i = 0; $i < count($items); $i++) {
                $cantidadSolicitada = $items[$i]['nroSacos'];
                //echo 'cant. solicitada:' . $cantidadSolicitada . '<br>';
                $stockResultadoProducciones = StockResultadoProduccion::where('stock_producto_id', ($items[$i]['codProducto']))->get();
                while ($cantidadSolicitada > 0) {
                    foreach ($stockResultadoProducciones as $stockResultadoProduccion) {
                        if ($stockResultadoProduccion->cantidad_stock <= $cantidadSolicitada) {
                            $cantidadComprada = $cantidadComprada + $stockResultadoProduccion->cantidad_stock;
                            $cantidadSolicitada = $cantidadSolicitada - $cantidadComprada;
                            $stockResultadoProduccion->cantidad_stock = 0;
                            $stockResultadoProduccion->estado_stock = true;
                            $stockResultadoProduccion->save();
                            if($cantidadComprada > 0) {
                                DetalleVenta::create([
                                    'venta_id' => $venta->id,
                                    'stock_resultado_produccions_id' => $stockResultadoProduccion->id,
                                    'cantidad' => $cantidadComprada,
                                    'kilos' => $items[$i]['sacosKilos'],
                                    'stock_producto_id' => $items[$i]['codProducto'],
                                    'precio' => $items[$i]['precio'],
                                    'fecha_registro' => Carbon::now(),
                                    'estado' => 'Habilitado'
                                ]);
                            }
                            //echo $stockResultadoProduccion->cantidad_stock.' cant comprada:'.$cantidadComprada.' cant. solicitada:'.$cantidadSolicitada.'<br>';
                        } else if ($stockResultadoProduccion->cantidad_stock > $cantidadSolicitada) {
                            if($cantidadSolicitada > 0) {
                                $cantidadComprada += $cantidadSolicitada;
                                $stockResultadoProduccion->cantidad_stock = $stockResultadoProduccion->cantidad_stock - $cantidadSolicitada;
                                if ($stockResultadoProduccion->cantidad_stock == 0) {
                                    $stockResultadoProduccion->estado_stock = true;
                                }
                                $stockResultadoProduccion->save();

                                DetalleVenta::create([
                                    'venta_id' => $venta->id,
                                    'stock_resultado_produccions_id' => $stockResultadoProduccion->id,
                                    'cantidad' => $cantidadSolicitada,
                                    'kilos' => $items[$i]['sacosKilos'],
                                    'stock_producto_id' => $items[$i]['codProducto'],
                                    'precio' => $items[$i]['precio'],
                                    'fecha_registro' => Carbon::now(),
                                    'estado' => 'Habilitado'
                                ]);

                                $cantidadSolicitada -= $cantidadSolicitada;
                            }
                            //echo $stockResultadoProduccion->cantidad_stock.' cant comprada en else if:'.$cantidadComprada.'cant solicitada:'.$cantidadSolicitada.'<br>';
                        }
                        //echo 'cant Solicitada'.$cantidadSolicitada.' canti comprada'.$cantidadComprada.'<br>';
                    }
                }
                $cantidadComprada = 0;
            }
            //dd($cantidadSolicitada);
        };
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show(Ventas $ventas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Ventas::find($id);
        //$ventas

        $agricultores = CompradorPersona::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('nombres_completos','id')->toArray();

        $empresas =CompradorEmpresa::select(DB::raw("razon_social"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('razon_social','id')->toArray();

        $productos = StockProductoItem::where('estado','Habilitado')->get();

        return view('ventas.edit',compact('venta','agricultores','empresas','productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $items = null;
        $cantidadSolicitada = 0;
        $cantidadComprada = 0;

        $venta = Ventas::find($request['venta_id']);
        if(request()->ajax()) {
            $items = request()->items;

            $data = request()->validate([
                'nro_guia_venta' => 'required',
                'fecha' => 'required',
                'hora' => 'required',
                'optradio' => 'required',
                'agricultor' => 'nullable',
                'empresa' => 'nullable',
                //'tipo_comprobante' => 'required',
                //'serie_comprobante' => 'required',
                'sub_total' => 'required',
                'igv' => 'required',
                'total' => 'required',
                'observacion' => 'required',
                'monto_descripcion' => 'required'
            ]);

            $venta->fecha_venta = $data['fecha'];
            $venta->hora_venta = $data['hora'];
            $venta->comprador_agricultor_id = isset($data['agricultor']) ? $data['agricultor'] : null;
            $venta->comprador_empresa_id = isset($data['empresa']) ? $data['empresa'] : null;


            $ventasDetalles = DetalleVenta::where('venta_id', $venta->id)->get();

            foreach ($ventasDetalles as $ventasDetalle) {
                $stockResultadoProduccion = StockResultadoProduccion::find($ventasDetalle->stock_resultado_produccions_id);
                $stockResultadoProduccion->cantidad_stock = $stockResultadoProduccion->cantidad_stock + $ventasDetalle->cantidad;
                $stockResultadoProduccion->estado_stock = 1;
                $stockResultadoProduccion->save();
                $ventasDetalle->estado = 'Eliminado';
                $ventasDetalle->save();
            }

            for ($i = 0; $i < count($items); $i++) {
                $cantidadSolicitada = $items[$i]['nroSacos'];
                //echo 'cant. solicitada:' . $cantidadSolicitada . '<br>';
                $stockResultadoProducciones = StockResultadoProduccion::where('stock_producto_id', ($items[$i]['codProducto']))->get();
                while ($cantidadSolicitada > 0) {
                    foreach ($stockResultadoProducciones as $stockResultadoProduccion) {
                        if ($stockResultadoProduccion->cantidad_stock <= $cantidadSolicitada) {
                            $cantidadComprada = $cantidadComprada + $stockResultadoProduccion->cantidad_stock;
                            $cantidadSolicitada = $cantidadSolicitada - $cantidadComprada;
                            $stockResultadoProduccion->cantidad_stock = 0;
                            $stockResultadoProduccion->estado_stock = true;
                            $stockResultadoProduccion->save();
                            if($cantidadComprada > 0) {
                                DetalleVenta::create([
                                    'venta_id' => $venta->id,
                                    'stock_resultado_produccions_id' => $stockResultadoProduccion->id,
                                    'cantidad' => $cantidadComprada,
                                    'kilos' => $items[$i]['sacosKilos'],
                                    'stock_producto_id' => $items[$i]['codProducto'],
                                    'precio' => $items[$i]['precio'],
                                    'fecha_registro' => Carbon::now(),
                                    'estado' => 'Habilitado'
                                ]);
                            }
                            //echo $stockResultadoProduccion->cantidad_stock.' cant comprada:'.$cantidadComprada.' cant. solicitada:'.$cantidadSolicitada.'<br>';
                        } else if ($stockResultadoProduccion->cantidad_stock > $cantidadSolicitada) {
                            if($cantidadSolicitada > 0) {
                                $cantidadComprada += $cantidadSolicitada;
                                $stockResultadoProduccion->cantidad_stock = $stockResultadoProduccion->cantidad_stock - $cantidadSolicitada;
                                if ($stockResultadoProduccion->cantidad_stock == 0) {
                                    $stockResultadoProduccion->estado_stock = true;
                                }
                                $stockResultadoProduccion->save();

                                DetalleVenta::create([
                                    'venta_id' => $venta->id,
                                    'stock_resultado_produccions_id' => $stockResultadoProduccion->id,
                                    'cantidad' => $cantidadSolicitada,
                                    'kilos' => $items[$i]['sacosKilos'],
                                    'stock_producto_id' => $items[$i]['codProducto'],
                                    'precio' => $items[$i]['precio'],
                                    'fecha_registro' => Carbon::now(),
                                    'estado' => 'Habilitado'
                                ]);

                                $cantidadSolicitada -= $cantidadSolicitada;
                            }
                            //echo $stockResultadoProduccion->cantidad_stock.' cant comprada en else if:'.$cantidadComprada.'cant solicitada:'.$cantidadSolicitada.'<br>';
                        }
                        //echo 'cant Solicitada'.$cantidadSolicitada.' canti comprada'.$cantidadComprada.'<br>';
                    }
                }
                $cantidadComprada = 0;
            }
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $venta = Ventas::find($request['id']);

        $ventasDetalles = DetalleVenta::where('venta_id',$venta->id)->get();

        foreach ($ventasDetalles as $ventasDetalle){
            $stockResultadoProduccion = StockResultadoProduccion::find($ventasDetalle->stock_resultado_produccions_id);
            $stockResultadoProduccion->cantidad_stock = $stockResultadoProduccion->cantidad_stock + $ventasDetalle->cantidad;
            $stockResultadoProduccion->estado_stock = 1;
            $stockResultadoProduccion->save();
            $ventasDetalle->estado = 'Eliminado';
            $ventasDetalle->save();
        }
        $venta->estado = "Eliminado";
        $venta->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function listarAgricultor(Request $request)
    {
        $term = $request->term ?:'';
//        $agricultores =Agricultor::select(DB::raw("CONCAT(apellidos,' ',nombres,' ',dni) as nombres_completos"),'id')
        $agricultores =CompradorPersona::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->where('apellidos','like','%'.$term.'%')
            //->orWhere('nombres','like','%'.$term.'%')
            ->orWhere('dni','like','%'.$term.'%')
            ->orWhere('ruc','like','%'.$term.'%')
            ->get()->pluck('nombres_completos','id')->toArray();

        $listarsagricultor = [];
        foreach ($agricultores as $id => $tag){
            $agricultor = CompradorPersona::find($id);
            if($agricultor->estado == 'Habilitado'){
                $listarsagricultor[] = ['id'=>$id,'text'=>$tag];
            }

        }

        return response()->json(
            $listarsagricultor
        );
    }

    public function listarEmpresa(Request $request)
    {
        $term = $request->term ?:'';
        $empresas =CompradorEmpresa::select(DB::raw("razon_social"),'id')
            ->where('estado','=','Habilitado')
            ->where('razon_social','like','%'.$term.'%')
            ->orWhere('ruc','like','%'.$term.'%')
            ->get()->pluck('razon_social','id')->toArray();

        $listaempresa = [];
        foreach ($empresas as $id => $tag){
            $empresa = CompradorEmpresa::find($id);
            if($empresa->estado == 'Habilitado')
            {
                $listaempresa[] = ['id'=>$id,'text'=>$tag];
            }
        }

        return response()->json(
            $listaempresa
        );
    }

    public function tipoBoleta(){
        $ventas = null;
        $serie = null;

        if(request()->tipo_comprobante == "BOLETA"){
            $ventas = Ventas::where('estado','Habilitado')->where('tipo_comprobante','BOLETA')->get()->last();
            if(is_null($ventas) || is_null($ventas->generarSerieBoleta())){
              $serie = "BOL-000001";
            }else{
              $serie = $ventas->generarSerieBoleta();
            }
        }else if(request()->tipo_comprobante == "FACTURA"){
            $ventas = Ventas::where('estado','Habilitado')->where('tipo_comprobante','FACTURA')->get()->last();
            if(is_null($ventas) || is_null($ventas->generarSerieFactura())){
                $serie = "FACT-000001";
            }else{
                $serie = $ventas->generarSerieFactura();
            }
        }else if(request()->tipo_comprobante == "TICKET"){
            $ventas = Ventas::where('estado','Habilitado')->where('tipo_comprobante','TICKET')->get()->last();
            if(is_null($ventas) || is_null($ventas->generarSerieTicket())){
                $serie = "TICK-000001";
            }else{
                $serie = $ventas->generarSerieTicket();
            }
        }

        return response()->json(["resultado"=>$serie]);
    }

    public function listarStock(){
        $stockProductoItem = StockProductoItem::find(request()->producto);
        $stockResultadProduccion = StockResultadoProduccion::where('stock_producto_id',request()->producto)->get();

        //dd($stockResultadProduccion);
        return response()->json(["resultado"=>$stockResultadProduccion->sum('cantidad_stock'),"producto"=>$stockProductoItem]);
    }

    public function reporteDetalle($id){
        $venta = Ventas::find($id);

        $detalleVentas = DetalleVenta::join('stock_producto_items','stock_producto_items.id','=','detalle_ventas.stock_producto_id')
            ->select(\DB::raw('detalle_ventas.stock_producto_id,sum(cantidad) as cantidad,detalle_ventas.kilos,detalle_ventas.precio'),'stock_producto_items.descripcion_producto')
            ->where('venta_id',$id)->where('detalle_ventas.estado','Habilitado')
            ->groupBy('stock_producto_id','kilos','precio','descripcion_producto')->get();

        //dd($detalleVentas);
        $view = View::make('ventas.reporte.reporte',compact('venta','detalleVentas'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }

    public function search(Request $request){
        $ventas = null;
        //dd(request()->all());
        if(request()->filtro == "persona"){
            $ventas = Ventas::join('comprador_personas','ventas.comprador_persona_id','=','comprador_personas.id')->
            where('comprador_personas.estado','Habilitado')->where('tipo_cliente','agricultor')
                ->where('comprador_personas.apellidos', 'like', '%' . request()->buscador . '%')
                ->orWhere('comprador_personas.dni', 'like', '%' . request()->buscador . '%')
                ->where(function($query){
                    $query->whereBetween('fecha_venta',[request()->fecha_desde,request()->fecha_hasta]);
                })
                ->orderBy('fecha_venta', 'desc')
                ->orderBy('hora_venta', 'desc')
                ->paginate(10);
        }else if(request()->filtro == "empresa"){
            $ventas = Ventas::join('comprador_empresas','ventas.comprador_empresa_id','=','comprador_empresas.id')->
            where('comprador_empresas.estado','Habilitado')->where('tipo_cliente','empresa')
                ->where('comprador_empresas.razon_social', 'like', '%' . request()->buscador . '%')
                ->orWhere('comprador_empresas.ruc', 'like', '%' . request()->buscador . '%')
                ->whereBetween('fecha_venta',[request()->fecha_desde,request()->fecha_hasta])
                ->orderBy('fecha_venta', 'desc')
                ->orderBy('hora_venta', 'desc')
                ->paginate(10);
        } else if(request()->filtro == null){
            $ventas = Ventas::where('estado','Habilitado')
                ->orderBy('fecha_venta', 'desc')
                ->orderBy('hora_venta', 'desc')
                ->paginate(10);
        } else{
            $ventas = Ventas::where('estado','Habilitado')
                ->whereBetween('fecha_venta',[request()->fecha_desde,request()->fecha_hasta])
                ->orderBy('fecha_venta', 'desc')
                ->orderBy('hora_venta', 'desc')
                ->paginate(10);
        }
        $view = view('ventas.tabla',compact('ventas'))->render();
        return response()->json(['html'=>$view]);
    }


}
