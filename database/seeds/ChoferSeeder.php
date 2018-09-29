<?php

use Illuminate\Database\Seeder;

class ChoferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Chofer::class,20)->create();
    }
}
