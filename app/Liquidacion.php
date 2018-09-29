<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = "liquidaciones";
    public $timestamps = false;

    protected $fillable = [
        'serie_liquidacion',
        'lote_id',
        'estado_liquidacion',
        'fecha_registro',
        'estado'
    ];

    public function lote(){
        return $this->belongsTo(Lote::class);
    }

    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->serie_liquidacion,'LIQ-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "LIQ-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "LIQ-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "LIQ-000" . $valor;
                break;
            case 4:
                $nuevaserie = "LIQ-00" . $valor;
                break;
            case 5:
                $nuevaserie = "LIQ-0" . $valor;
                break;
            case 6:
                $nuevaserie = "LIQ-" . $valor;
                break;
            default:
                $nuevaserie = "LIQ-" . $valor;
                break;
        }

        return $nuevaserie;
    }
}
