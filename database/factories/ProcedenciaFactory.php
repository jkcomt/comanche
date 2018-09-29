<?php

use Faker\Generator as Faker;

$factory->define(App\Procedencia::class, function (Faker $faker) {
    return [
        'lugar'=>$faker->city,
        'estado'=>'Habilitado'
    ];
});
