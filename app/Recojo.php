<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recojo extends Model
{
    protected $table = "recojos";

    protected $fillable = [
        'nro_guia_recojo',
        'fecha',
        'hora',
        'nro_sacos_recogidos',
        'kilos_recogidos',
        'peso_recogidos',
        'nro_sacos_no_recogidos',
        'kilos_no_recogidos',
        'peso_no_recogido',
        'importe_sacos',
        'importe_total',
        'humedad_al_recoger',
        'observacion',
        'estado',
        'almacen_id',
        'tendido_id'
    ];

    public function tendido()
    {
        return $this->belongsTo(Tendido::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }


    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->nro_guia_recojo,'RCJ-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "RCJ-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "RCJ-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "RCJ-000" . $valor;
                break;
            case 4:
                $nuevaserie = "RCJ-00" . $valor;
                break;
            case 5:
                $nuevaserie = "RCJ-0" . $valor;
                break;
            case 6:
                $nuevaserie = "RCJ-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function ultimoRecojo(){
        return Recojo::where('estado','Habilitado')->get()->last();
    }

    public $timestamps = false;
}
