<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = "vehiculos";

    protected $fillable = [
        'marca', 'descripcion', 'placa','estado'
    ];

    public function lote()
    {
        return $this->hasMany(Lote::class);
    }

    public $timestamps = false;
}
