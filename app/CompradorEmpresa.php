<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompradorEmpresa extends Model
{
    protected $table = "comprador_empresas";

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
