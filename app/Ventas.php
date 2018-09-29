<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = "ventas";

    protected $fillable = [
      'nro_guia_venta',
      'fecha_venta',
      'hora_venta',
      'tipo_cliente',
      'comprador_persona_id',
      'comprador_empresa_id',
      'tipo_comprobante',
      'nro_boleta',
      'nro_factura',
      'nro_ticket',
      'igv',
      'total',
      'observacion',
      'monto_descripcion',
      'fecha_registro',
      'estado'
    ];

    public function DetalleVentas(){
        return $this->hasMany(DetalleVenta::class);
    }

    public function compradorPersona(){
        return $this->belongsTo(CompradorPersona::class);
    }

    public function compradorEmpresa(){
        return $this->belongsTo(CompradorEmpresa::class);
    }

    public function generarSerieVenta()
    {
        $ultimaserie = str_after($this->nro_guia_venta,'VENT-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "VENT-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "VENT-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "VENT-000" . $valor;
                break;
            case 4:
                $nuevaserie = "VENT-00" . $valor;
                break;
            case 5:
                $nuevaserie = "VENT-0" . $valor;
                break;
            case 6:
                $nuevaserie = "VENT-" . $valor;
                break;
            default:
                $nuevaserie = "VENT-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function generarSerieBoleta()
    {
        $ultimaserie = str_after($this->nro_boleta,'BOL-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "BOL-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "BOL-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "BOL-000" . $valor;
                break;
            case 4:
                $nuevaserie = "BOL-00" . $valor;
                break;
            case 5:
                $nuevaserie = "BOL-0" . $valor;
                break;
            case 6:
                $nuevaserie = "BOL-" . $valor;
                break;
            default:
                $nuevaserie = "BOL-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function generarSerieFactura()
    {
        $ultimaserie = str_after($this->nro_factura,'FACT-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "FACT-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "FACT-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "FACT-000" . $valor;
                break;
            case 4:
                $nuevaserie = "FACT-00" . $valor;
                break;
            case 5:
                $nuevaserie = "FACT-0" . $valor;
                break;
            case 6:
                $nuevaserie = "FACT-" . $valor;
                break;
            default:
                $nuevaserie = "FACT-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public function generarSerieTicket()
    {
        $ultimaserie = str_after($this->nro_factura,'TICK-');
        $valor = $ultimaserie+1;
        $longitud = strlen($valor);

        $nuevaserie = "";
        switch ($longitud) {
            case 1:
                $nuevaserie = "TICK-00000" . $valor;
                break;
            case 2:
                $nuevaserie = "TICK-0000" . $valor;
                break;
            case 3:
                $nuevaserie = "TICK-000" . $valor;
                break;
            case 4:
                $nuevaserie = "TICK-00" . $valor;
                break;
            case 5:
                $nuevaserie = "TICK-0" . $valor;
                break;
            case 6:
                $nuevaserie = "TICK-" . $valor;
                break;
            default:
                $nuevaserie = "TICK-" . $valor;
                break;
        }

        return $nuevaserie;
    }

    public $timestamps = false;

}
