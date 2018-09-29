<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables(
            [
                'responsable_cuadrillas',
                'vehiculos',
                'variedades',
                'procedencias',
                'personales',
                //'clientes',
                'choferes',
                'empresas',
                'agricultores',
                'areas',
                'users',
                'lotes',
                'lote_secados',
                'tendidos',
                'almacenes',
                'stock_producto_items'
            ]
        );
        // $this->call(UsersTableSeeder::class);
      //  $this->call(VehiculoSeeder::class);
      //  $this->call(VariedadSeeder::class);
      //  $this->call(ProcedenciaSeeder::class);
        $this->call(PersonalSeeder::class);
        //$this->call(ResponsableSeeder::class);
        //$this->call(ClienteSeeder::class);
        //$this->call(ChoferSeeder::class);
        //$this->call(AgricultorSeeder::class);
        //$this->call(EmpresaSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(UserSeeder::class);
        //$this->call(LoteSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(StockProductoItemSeeder::class);

    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tables as $table){
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
