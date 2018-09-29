<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = "lotes";

    protected $fillable = [
        'compania',
        'nro_guia',
        'fecha',
        'hora',
        'tipo_recepcion',
        'tipo_peso',
        'nro_sacos',
        'kilos',
        'peso_real',
        'tipo_flete',
        'pagado_por',
        'flete_x_saco',
        'flete_x_peso',
        'flete_x_tonelada',
        'flete_total',
        'nro_humedad_mayor_13',
        'nro_humedad_menor_13',
        'observacion',
        'conforme',
        'estado',
        'personal_id',
        'vehiculo_id',
        'chofer_id',
        'procedencia_id',
        'cliente_id',
        'agricultor_id',
        'empresa_id',
        'variedad_id'
    ];

    public function personal(){
        return $this->belongsTo(Personal::class);
    }

    public function vehiculo(){
        return $this->belongsTo(Vehiculo::class);
    }

    public function chofer(){
        return $this->belongsTo(Chofer::class);
    }

    public function procedencia(){
        return $this->belongsTo(Procedencia::class);
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function agricultor(){
        return $this->belongsTo(Agricultor::class);
    }

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function variedad(){
        return $this->belongsTo(Variedad::class);
    }

    public function loteSecado()
    {
        return $this->hasOne(LoteSecado::class);
    }

    public function produccionIngreso(){
        return $this->hasMany(ProduccionIngreso::class);
    }

    public function stockResultadoProduccion(){
        return $this->hasMany(StockResultadoProduccion::class);
    }

    public function generarSerieGuia()
    {
        $ultimaserie = str_after($this->nro_guia,'REC-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "REC-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "REC-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "REC-000" . $valor;
                break;
            case 4:
                $nuevaserie = "REC-00" . $valor;
                break;
            case 5:
                $nuevaserie = "REC-0" . $valor;
                break;
            case 6:
                $nuevaserie = "REC-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function ultimoLote(){
        return Lote::where('estado','Habilitado')->get()->last();
    }

    public function liquidacion(){
        return $this->hasOne(Liquidacion::class);
    }

    public function produccionIngresoNoConforme(){
        $producionIngresos = $this->produccionIngreso()->where('conforme',false)->get();
        if($producionIngresos->count() > 0){
            return false;
        }else{
            return true;
        }
    }

    public function loteSecadoNoConforme(){
        $loteSecado = $this->loteSecado()->where('conforme',false)->get();
        if($loteSecado->count() > 0){
            return false;
        }else{
            return true;
        }
    }

    public function stockResultadoProduccionNoConforme(){
        $stockResultadoProducciones = $this->stockResultadoProduccion()->where('estado_stock',false)->get();
        if($stockResultadoProducciones->count() > 0)
        {
            return false;
        }else{
            return true;
        }
    }

    public $timestamps = false;
}
