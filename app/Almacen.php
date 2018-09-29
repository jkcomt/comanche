<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = 'almacenes';

    protected $fillable = [
        'nombre',
        'estado'
    ];

    public function recojo()
    {
        $this->hasMany(Recojo::class);
    }

    public $timestamps = false;
}
