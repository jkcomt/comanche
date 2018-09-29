<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variedad extends Model
{
    protected $table = "variedades";

    protected $fillable = [
        'descripcion','estado'
    ];

    public $timestamps = false;
}
