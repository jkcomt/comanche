<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "areas";

    protected $fillable = [
        'descripcion',
        'estado'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public $timestamps = false;
}
