<?php

use Illuminate\Database\Seeder;
use App\Personal;
class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Personal::class,1)->create();
    }
}
