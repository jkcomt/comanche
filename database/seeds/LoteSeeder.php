<?php

use Illuminate\Database\Seeder;
use App\Lote;
class LoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i<10;$i++){

            if($i == 4)
            {
                factory(Lote::class)->create([
                    'nro_guia'=>'001-00000'.$i,
                    'tipo_recepcion'=>'Cliente',
                    'cliente_id'=>1,
                    'agricultor_id'=>null,
                    'pagado_por'=>'Cliente',
                    'conforme'=>true
                ]);
            }else{
                factory(Lote::class)->create([
                    'nro_guia'=>'001-00000'.$i,
                ]);
            }

        }


    }
}
