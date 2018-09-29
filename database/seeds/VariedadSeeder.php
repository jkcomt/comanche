<?php

use Illuminate\Database\Seeder;
use App\Variedad;
class VariedadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Variedad::class,10)->create();
    }
}
