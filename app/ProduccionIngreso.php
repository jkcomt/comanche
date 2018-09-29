<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduccionIngreso extends Model
{
    protected $table = "produccion_ingresos";

    protected $fillable = [
        'nro_guia_ingreso',
        'lote_id',
        'lote_secado_id',
        'estado_prod_ingreso',
        'nro_sacos_ingresados',
        'kilo_por_saco',
        'area_origen',
        'conforme',
        'fecha',
        'hora',
        'estado'
    ];

    public function lote(){
        return $this->belongsTo(Lote::class);
    }

    public function loteSecado(){
        return $this->belongsTo(LoteSecado::class);
    }

    public function nuevaProduccion(){
        return $this->hasMany(NuevaProduccion::class);
    }

    public function ultimaNuevaProduccion(){
        return $this->hasOne(NuevaProduccion::class)->latest();
    }

    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->nro_guia_ingreso,'PROD-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "PROD-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "PROD-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "PROD-000" . $valor;
                break;
            case 4:
                $nuevaserie = "PROD-00" . $valor;
                break;
            case 5:
                $nuevaserie = "PROD-0" . $valor;
                break;
            case 6:
                $nuevaserie = "PROD-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function validarDetallesRegistrosAnteriores(){
        $produccionesAnteriores = ProduccionIngreso::where('estado','Habilitado')->where('id','<',$this->id)->get();
        $estado = true;
        foreach ($produccionesAnteriores as $produccioAnterior)
        {
            if($produccioAnterior->nuevaProduccion->count() > 0 && $produccioAnterior->estado_prod_ingreso == "en proceso"){
                $estado = false;
            }
        }

        return $estado;
    }

    public $timestamps = false;
}
