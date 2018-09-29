<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponsableCuadrilla extends Model
{
    protected $table = "responsable_cuadrillas";

    protected $fillable = [
        'apellidos', 'nombres', 'dni','celular','estado'
    ];

    public function tendido()
    {
        return $this->hasMany(Tendido::class);
    }

    public $timestamps = false;
}
