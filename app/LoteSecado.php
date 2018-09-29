<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoteSecado extends Model
{
    protected $table = "lote_secados";

    protected $fillable = [
        'lote_id',
        'nro_serie_guia',
        'estado_secado',
        'conforme',
        'fecha',
        'hora',
        'estado'
        ];

    public function lote()
    {
        return $this->belongsTo(Lote::class);
    }

    public function tendido()
    {
        return $this->hasMany(Tendido::class);
    }

    public function produccionIngreso(){
        return $this->hasOne(ProduccionIngreso::class);
    }

    public function ultimoTendido()
    {
        return $this->tendido->where('estado','Habilitado')->last();
    }

    public function accionesDisponibles()
    {
        $secados = LoteSecado::where('id','=',$this->id-1)->where('estado','=','Habilitado')->get();
        $resultado = false;
        if(!$secados->isEmpty())
        {
            foreach ($secados as $secado)
            {
                if($secado->estado_secado == 'en proceso')
                {
                    $resultado =  true;
                }else if($secado->estado_secado != 'en proceso'){
                    $resultado =  true;
                }
            }
        }else{
            $resultado = true;
        }
        return $resultado;
    }

    public function sumatotalrecojos(){
        $loteSecado = DB::table('recojos')->join('tendidos','recojos.tendido_id','=','tendidos.id')
            ->join('lote_secados','tendidos.lote_secado_id','=','lote_secados.id')
            ->where('lote_secados.id','=',$this->id)
            ->sum('recojos.peso_recogidos');

        return $loteSecado;
    }

    public function sumtatotalnrosacosrecogidos(){
        $loteSecado = DB::table('recojos')->join('tendidos','recojos.tendido_id','=','tendidos.id')
            ->join('lote_secados','tendidos.lote_secado_id','=','lote_secados.id')
            ->where('lote_secados.id','=',$this->id)
            ->where('recojos.estado','Habilitado')
            ->sum('recojos.nro_sacos_recogidos');

        return $loteSecado;
    }

    public function sumtatotalkilossacosrecogidos(){
        $loteSecado = DB::table('recojos')->join('tendidos','recojos.tendido_id','=','tendidos.id')
            ->join('lote_secados','tendidos.lote_secado_id','=','lote_secados.id')
            ->where('lote_secados.id','=',$this->id)
            ->where('recojos.estado','Habilitado')
            ->sum('recojos.peso_recogidos');

        return $loteSecado;
    }

    public function sumtatotalkilossacosnorecogidos(){
        $loteSecado = DB::table('recojos')->join('tendidos','recojos.tendido_id','=','tendidos.id')
            ->join('lote_secados','tendidos.lote_secado_id','=','lote_secados.id')
            ->where('lote_secados.id','=',$this->id)
            ->where('recojos.estado','Habilitado')
            ->sum('recojos.peso_no_recogido');

        return $loteSecado;
    }

    public function sumtatotalsacosnorecogidos(){
        $loteSecado = DB::table('recojos')->join('tendidos','recojos.tendido_id','=','tendidos.id')
            ->join('lote_secados','tendidos.lote_secado_id','=','lote_secados.id')
            ->where('lote_secados.id','=',$this->id)
            ->where('recojos.estado','Habilitado')
            ->sum('recojos.nro_sacos_no_recogidos');

        return $loteSecado;
    }


    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->nro_serie_guia,'SEC-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "SEC-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "SEC-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "SEC-000" . $valor;
                break;
            case 4:
                $nuevaserie = "SEC-00" . $valor;
                break;
            case 5:
                $nuevaserie = "SEC-0" . $valor;
                break;
            case 6:
                $nuevaserie = "SEC-" . $valor;
                break;
            default:
                $nuevaserie = "SEC-".$valor;
        }

        return $nuevaserie;
    }



    public $timestamps = false;
}
