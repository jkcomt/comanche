<?php

use Illuminate\Database\Seeder;
use App\Area;
class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Area::class)->create([
            'descripcion'=>'administrador'
        ]);

        factory(Area::class)->create([
           'descripcion'=>'recepcion'
        ]);

        factory(Area::class)->create([
            'descripcion'=>'secado'
        ]);

        factory(Area::class)->create([
            'descripcion'=>'produccion'
        ]);

        factory(Area::class)->create([
            'descripcion'=>'ventas'
        ]);

        factory(Area::class)->create([
            'descripcion'=>'gerencia'
        ]);
    }
}
