<?php

use Illuminate\Database\Seeder;
use App\Agricultor;
class AgricultorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Agricultor::class,10)->create();
    }
}
