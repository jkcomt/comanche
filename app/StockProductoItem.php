<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockProductoItem extends Model
{
    protected $table = "stock_producto_items";
    public $timestamps = false;

    protected $fillable = [
        'serie_producto',
        'descripcion_producto',
        'precio',
        'kilos',
        'fecha_registro',
        'estado'
    ];

    public function StockResultadoProduccion(){
       return $this->hasMany(StockResultadoProduccion::class);
    }
}
