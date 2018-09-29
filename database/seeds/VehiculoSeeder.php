<?php

use Illuminate\Database\Seeder;
use App\Vehiculo;
class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Vehiculo::class,10)->create();
    }
}
