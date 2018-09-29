<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = "personales";

    protected $fillable = [
        'apellidos', 'nombres', 'dni','celular','direccion','email','estado'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }


    public $timestamps = false;
}
