<?php

use Illuminate\Database\Seeder;
use App\Procedencia;
class ProcedenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Procedencia::class,20)->create();
    }
}
