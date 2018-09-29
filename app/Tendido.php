<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tendido extends Model
{
    protected $table = "tendidos";

    protected $fillable = [
        'nro_guia_tendido',
        'fecha',
        'hora',
        'nro_sacos_pre_secado',
        'kilos_pre_secado',
        'nro_sacos_a_secar',
        'kilos_a_secar',
        'nro_sacos_no_secado',
        'kilos_no_secado',
        'lote_secado_id',
        'responsable_id',
        'observacion',
        'estado',
        'estado_tendido'
    ];

    public function loteSecado()
    {
        return $this->belongsTo(LoteSecado::class);
    }

    public function responsable()
    {
        return $this->belongsTo(ResponsableCuadrilla::class);
    }

    public function recojo()
    {
        return $this->hasMany(Recojo::class);
    }

    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->nro_guia_tendido,'TEN-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "TEN-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "TEN-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "TEN-000" . $valor;
                break;
            case 4:
                $nuevaserie = "TEN-00" . $valor;
                break;
            case 5:
                $nuevaserie = "TEN-0" . $valor;
                break;
            case 6:
                $nuevaserie = "TEN-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function sumaRecojos()
    {
        return $this->recojo->where('estado','Habilitado')->sum('nro_sacos_recogidos');
    }

    public function ultimoNroSacosNoRecogidos(){
        $resultado = false;
        $recojo = Recojo::where('estado','Habilitado')->where('tendido_id',$this->id)->get()->last();
        if($recojo != null){
            if($recojo->nro_sacos_no_recogidos == 0){
                $resultado = true;
            }else{
                $resultado = false;
            }
        }else{
            return false;
        }

        return $resultado;
    }

    public function accionesDisponibles()
    {
        $tendidos = Tendido::where('id','=',$this->id-1)->where('estado','=','Habilitado')->get();
        $resultado = 'false';
        if(!$tendidos->isEmpty())
        {
            foreach ($tendidos as $tendido)
            {
                if($tendido->estado_secado == 'en proceso') {
                    if ($tendido->loteSecado->id == $this->loteSecado->id) {
                        $resultado = 'es igual ' . $tendido->loteSecado;

                    } else if ($tendido->estado_secado != 'en proceso') {
                        $resultado = 'no es igual ' . $tendido->loteSecado . '-' . $this->loteSecado->id;
                    }
                }
            }
        }else{
            $resultado = 'no existe';
        }
        return $resultado;
    }

    public function totalImporteAlmacen(){
        $recojos = $this->recojo->where('estado','Habilitado')->sum('importe_sacos');

        return $recojos;
    }



    public $timestamps = false;
}
