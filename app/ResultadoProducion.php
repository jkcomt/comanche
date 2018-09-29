<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoProducion extends Model
{
    protected $table = "resultado_produciones";

    protected $fillable = [
        'producto',
        'nro_sacos',
        'kilos',
        'precio_maquila',
        'sub_total_maquila',
        'nro_envases',
        'envase',
        'precio_envase',
        'sub_total_envase',
        'adicional',
        'sub_total_adicional',
        'nueva_produccion_id',
        'estado'
    ];

    public function produccionIngreso(){
        return $this->belongsTo(NuevaProduccion::class);
    }

    public $timestamps = false;


}
