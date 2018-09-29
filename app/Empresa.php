<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresas";

    protected $fillable = [
        'razon_social',
        'ruc',
        'direccion',
        'telefono',
        'email',
        'representante',
        'dni_representante',
        'estado'
    ];

    public $timestamps = false;
}
