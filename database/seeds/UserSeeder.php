<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(
            [
                'name'=>'Admin',
//                'email'=>'admin@email.com',
                'password'=>'123456',
                'area_id'=>1,
//                'personal_id'=>1,
                'estado'=>'Habilitado'
            ]
        );

        //factory(User::class,5)->create();

    }
}
