<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NuevaProduccion extends Model
{
    protected $table = "nueva_producciones";

    protected $fillable = [
      'produccion_ingreso_id',
      'nro_guia_salida',
      'nro_sacos_stock_inicial',
      'kilos_total_inicial',
      'nro_sacos_a_procesar',
      'kilos_a_procesar',
      'nro_sacos_saldo',
      'kilos_total_saldo',
      'fecha',
      'hora',
      'estado'
    ];

    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->nro_guia_salida,'SAL-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "SAL-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "SAL-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "SAL-000" . $valor;
                break;
            case 4:
                $nuevaserie = "SAL-00" . $valor;
                break;
            case 5:
                $nuevaserie = "SAL-0" . $valor;
                break;
            case 6:
                $nuevaserie = "SAL-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public $timestamps = false;

    public function ingresoProduccion(){
        return $this->belongsTo(ProduccionIngreso::class,'produccion_ingreso_id');
    }

    public function resultadoProduccion(){
        return $this->hasMany(ResultadoProducion::class);
    }

}
