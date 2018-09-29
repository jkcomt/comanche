<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompradorPersona extends Model
{
    protected $table = "comprador_personas";

    protected $fillable = [
        'apellidos',
        'nombres',
        'dni',
        'celular',
        'direccion',
        'email',
        'estado',
        'ruc'
    ];

    public $timestamps = false;
}
