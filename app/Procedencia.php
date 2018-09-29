<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedencia extends Model
{
    protected $table = "procedencias";

    protected $fillable = [
        'lugar','estado'
    ];

    public $timestamps = false;
}
