<?php

namespace App\Http\Controllers;

use App\DetalleVenta;
use App\Liquidacion;
use Illuminate\Http\Request;
use View;
class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liquidaciones = Liquidacion::where('estado','Habilitado')->paginate(10);

        return view('liquidacion.index',compact('liquidaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function show(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liquidacion $liquidacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liquidacion  $liquidacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquidacion $liquidacion)
    {
        //
    }

    public function reporteDetalle($id){
        
        set_time_limit(120);
        $liquidacion = Liquidacion::find($id);

        $detalleVentas = \DB::table('detalle_ventas')->join('stock_resultado_producciones','detalle_ventas.stock_resultado_produccions_id','=','stock_resultado_producciones.id')
            ->join('stock_producto_items','stock_producto_items.id','detalle_ventas.stock_producto_id')
            ->select('detalle_ventas.stock_producto_id')
            ->select('stock_producto_items.descripcion_producto')
            ->selectRaw('sum(detalle_ventas.cantidad) as cantidad')
            ->selectRaw('detalle_ventas.kilos')
            ->selectRaw('detalle_ventas.precio')
            ->selectRaw('sum(detalle_ventas.cantidad) * detalle_ventas.precio as total')
            ->groupBy('detalle_ventas.stock_producto_id','stock_producto_items.descripcion_producto','detalle_ventas.precio','detalle_ventas.kilos')->get();

        //$sumaRecojos = $

        $view = View::make('liquidacion.reporte.reporte',compact('liquidacion','detalleVentas'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }
}
