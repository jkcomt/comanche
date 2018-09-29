<?php

namespace App\Http\Controllers;

use App\StockProductoItem;
use App\StockResultadoProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

class StockProductoItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $stockProductos = StockResultadoProduccion::
//            join('stock_producto_items','stock_producto_items.id','=','stock_resultado_producciones.stock_producto_id')
//            ->select(
//                'stock_producto_id',
//                DB::raw('SUM(cantidad_stock) as cantidad_stock'),
//                'stock_producto_items.serie_producto',
//                'stock_producto_items.descripcion_producto',
//                'stock_producto_items.precio',
//                'stock_producto_items.kilos'
//            )
//            //->Where('stock_resultado_producciones.estado',true)
//            ->groupBy(
//                'stock_producto_id',
//                'stock_producto_items.serie_producto',
//                'stock_producto_items.descripcion_producto',
//                'stock_producto_items.precio',
//                'stock_producto_items.kilos'
//            )->get();

        $stockProductos = StockProductoItem::
        leftjoin('stock_resultado_producciones','stock_resultado_producciones.stock_producto_id','=','stock_producto_items.id')
            ->select(
                'stock_producto_id',
                DB::raw('SUM(cantidad_stock) as cantidad_stock'),
                'stock_producto_items.serie_producto',
                'stock_producto_items.descripcion_producto',
                'stock_producto_items.precio',
                'stock_producto_items.kilos'
            )
            ->groupBy(
                'stock_producto_id',
                'stock_producto_items.serie_producto',
                'stock_producto_items.descripcion_producto',
                'stock_producto_items.precio',
                'stock_producto_items.kilos'
            )
            ->orderBy('serie_producto')
            ->get();

        return view('stock_productos.index',compact('stockProductos'));
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
     * @param  \App\StockProductoItem  $stockProductoItem
     * @return \Illuminate\Http\Response
     */
    public function show(StockProductoItem $stockProductoItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockProductoItem  $stockProductoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(StockProductoItem $stockProductoItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockProductoItem  $stockProductoItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockProductoItem $stockProductoItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockProductoItem  $stockProductoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockProductoItem $stockProductoItem)
    {
        //
    }

    public function buscarItemStock($id)
    {
        if(request()->ajax()){
            $stockProductoItem = StockProductoItem::find($id);
            return response()->json(["mensaje"=>$stockProductoItem]);
        }
    }

    public function updatePrecio()
    {
        if(request()->ajax()){
            $stockProductoItem = StockProductoItem::find(request()->stockItemId);
            $stockProductoItem->precio = request()->precio;
            $stockProductoItem->save();

            $stockProductos = StockProductoItem::
            leftjoin('stock_resultado_producciones','stock_resultado_producciones.stock_producto_id','=','stock_producto_items.id')
                ->select(
                    'stock_producto_id',
                    DB::raw('SUM(cantidad_stock) as cantidad_stock'),
                    'stock_producto_items.serie_producto',
                    'stock_producto_items.descripcion_producto',
                    'stock_producto_items.precio',
                    'stock_producto_items.kilos'
                )
                ->groupBy(
                    'stock_producto_id',
                    'stock_producto_items.serie_producto',
                    'stock_producto_items.descripcion_producto',
                    'stock_producto_items.precio',
                    'stock_producto_items.kilos'
                )
                ->orderBy('serie_producto')
                ->get();

            $view = view('stock_productos.tabla',compact('stockProductos'))->render();

            return response()->json(["mensaje"=>"Actualización Exitosa","html"=>$view]);
        }
    }

    public function reporte(){

        $stockProductos = StockProductoItem::
        leftjoin('stock_resultado_producciones','stock_resultado_producciones.stock_producto_id','=','stock_producto_items.id')
            ->select(
                'stock_producto_id',
                DB::raw('SUM(cantidad_stock) as cantidad_stock'),
                'stock_producto_items.serie_producto',
                'stock_producto_items.descripcion_producto',
                'stock_producto_items.precio',
                'stock_producto_items.kilos'
            )
            ->groupBy(
                'stock_producto_id',
                'stock_producto_items.serie_producto',
                'stock_producto_items.descripcion_producto',
                'stock_producto_items.precio',
                'stock_producto_items.kilos'
            )
            ->orderBy('serie_producto')
            ->get();

        $view = View::make('stock_productos.reporte.reporte',compact('stockProductos'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }
}
