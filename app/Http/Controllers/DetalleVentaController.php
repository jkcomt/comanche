<?php

namespace App\Http\Controllers;

use App\DetalleVenta;
use App\StockResultadoProduccion;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleVenta $detalleVenta)
    {
        //
    }

    public function listarDetalle($id){
        //$detalleVentas = DetalleVenta::where('venta_id',$id)->where('estado','Habilitado')->with(['Venta','StockResultadoProduccion.StockProduccionItem'])->get();
        $detalleVentas = DetalleVenta::join('stock_producto_items','stock_producto_items.id','=','detalle_ventas.stock_producto_id')
        ->select(\DB::raw('detalle_ventas.stock_producto_id,sum(cantidad) as cantidad,detalle_ventas.kilos,detalle_ventas.precio'),'stock_producto_items.descripcion_producto')
            ->where('venta_id',$id)->where('detalle_ventas.estado','Habilitado')
            ->groupBy('stock_producto_id','kilos','precio','descripcion_producto')->get();

        return response()->json($detalleVentas);
    }
}
