<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{
    protected $table = "agricultores";

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
