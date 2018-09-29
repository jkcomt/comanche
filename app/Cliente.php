<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
        'apellidos',
        'nombres',
        'dni',
        'celular',
        'direccion',
        'email',
        'tipo',
        'estado',
        'ruc'
    ];

    public $timestamps = false;
}
