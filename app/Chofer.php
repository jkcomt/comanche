<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    protected $table = "choferes";

    protected $fillable = [
        'apellidos', 'nombres', 'dni','celular','direccion','estado'
    ];

    public $timestamps = false;
}
