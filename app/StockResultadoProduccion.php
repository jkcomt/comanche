<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockResultadoProduccion extends Model
{
    protected $table = "stock_resultado_producciones";
    public $timestamps = false;

    protected $fillable = [
        'stock_producto_id',
        'lote_id',
        'produccion_ingreso_id',
        'nueva_produccion_id',
        'resultado_producion_id',
        'cantidad_inicial',
        'cantidad_stock',
        'kilos',
        'estado_stock',
        'fecha_registro',
        'hora_registro',
        'estado'
    ];

    public function StockProduccionItem(){
       return $this->belongsTo(StockProductoItem::class,'stock_producto_id');
    }

    public function Lote(){
        return $this->belongsTo(Lote::class);
    }

    public function ProduccionIngreso(){
        return $this->belongsTo(ProduccionIngreso::class);
    }

    public function ResultadoProduccion(){
        return $this->belongsTo(ResultadoProducion::class);
    }

    public function DetalleVenta(){
        return $this->hasMany(DetalleVenta::class,'stock_resultado_produccions_id');
    }
}
