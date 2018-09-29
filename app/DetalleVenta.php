<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalle_ventas";

    protected $fillable = [
      'venta_id',
      'stock_resultado_produccions_id',
      'stock_producto_id',
      'cantidad',
      'kilos',
      'precio',
      'fecha_registro',
      'estado'
    ];

    public function Venta(){
        return $this->belongsTo(Ventas::class);
    }

    public function StockResultadoProduccion(){
        return $this->belongsTo(StockResultadoProduccion::class,'stock_resultado_produccions_id');
    }

    public function StockProductoItem(){
        return $this->belongsTo(StockProductoItem::class,'stock_producto_id');
    }



    public $timestamps = false;


}
