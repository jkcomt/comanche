<?php

use Illuminate\Database\Seeder;
use App\Almacen;
class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Almacen::create([
           'nombre' => 'ARROZ POR SECAR',
            'estado'=> 'Habilitado'
        ]);

        Almacen::create([
            'nombre' => 'ARROZ SECO',
            'estado'=> 'Habilitado'
        ]);

        Almacen::create([
            'nombre' => 'ARROZ PILADO',
            'estado'=> 'Habilitado'
        ]);
    }
}
