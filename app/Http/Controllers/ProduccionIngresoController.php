<?php

namespace App\Http\Controllers;

use App\Liquidacion;
use App\ProduccionIngreso;
use App\ResultadoProducion;
use App\StockProductoItem;
use App\StockResultadoProduccion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Lote;
use View;

class ProduccionIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produccionIngresos = ProduccionIngreso::where(['estado'=>'Habilitado'])
            ->orderBy('fecha','desc')
            ->orderBy('hora','desc')
            ->paginate(10);

        return view('produccion.index',compact('produccionIngresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProduccionIngreso  $produccionIngreso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lote = Lote::with('agricultor','empresa','variedad','procedencia','chofer','vehiculo','produccionIngreso')->find($id);
//        dd($lote);
        return response()->json(
            $lote->toArray()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProduccionIngreso  $produccionIngreso
     * @return \Illuminate\Http\Response
     */
    public function edit(ProduccionIngreso $produccionIngreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProduccionIngreso  $produccionIngreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProduccionIngreso $produccionIngreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProduccionIngreso  $produccionIngreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProduccionIngreso $produccionIngreso)
    {
        //
    }

    public function markasread($id)
    {
        $user = \Auth::user();
        $notification = $user->notifications()->where('id',$id)->first();
        if($notification)
        {
            $notification->delete();
            return redirect('/produccion_ingreso');
        }else{
            return back()->withErrors('No pudimos encontrar la notificación');
        }
    }

    public function notifications()
    {
        $view = view('notificaciones.notificaciones')->render();
        return response()->json(['html'=>$view]);
    }

    public function search(Request $request){

        $produccionIngresos = null;
        //dd($request['filtro']);

        if($request['buscar'] != '')
        {
            if($request['filtro'] == "guia") {
                $produccionIngresos = ProduccionIngreso::select('produccion_ingresos.*')
                    ->leftjoin('lotes','produccion_ingresos.lote_id','lotes.id')
                    ->leftjoin('agricultores', 'lotes.agricultor_id', '=', 'agricultores.id')
                    ->leftjoin('empresas', 'lotes.empresa_id', '=', 'empresas.id')
                    ->where('produccion_ingresos.nro_guia_ingreso', 'like', '%' . $request['buscar'] . '%')
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc');

                $produccionIngresos = $produccionIngresos->where('produccion_ingresos.estado', 'Habilitado')
                    ->paginate(10);
            }elseif($request['filtro'] == "persona")
            {
                $produccionIngresos = ProduccionIngreso::select('produccion_ingresos.*')
                    ->leftjoin('lotes','produccion_ingresos.lote_id','lotes.id')
                    ->leftjoin('agricultores', 'lotes.agricultor_id', '=', 'agricultores.id')
                    ->where('lotes.estado','=','Habilitado')
                    ->where('agricultores.apellidos','like','%'.$request['buscar'].'%')
                    ->orWhere('agricultores.dni','like','%'.$request['buscar'].'%')
                    ->orWhere('agricultores.ruc','like','%'.$request['buscar'].'%')
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc');


                $produccionIngresos = $produccionIngresos->where('produccion_ingresos.estado', 'Habilitado')
                    ->paginate(10);
            }elseif($request['filtro'] == "empresa"){
                $produccionIngresos = ProduccionIngreso::select('produccion_ingresos.*')
                    ->leftjoin('lotes','produccion_ingresos.lote_id','lotes.id')
                    ->leftjoin('empresas', 'lotes.empresa_id', '=', 'empresas.id')
                    ->where('empresas.razon_social','like','%'.$request['buscar'].'%')
                    ->orWhere('empresas.ruc','like','%'.$request['buscar'].'%')
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc');

                $produccionIngresos = $produccionIngresos->where('produccion_ingresos.estado', 'Habilitado')
                    ->paginate(10);
            }
        }else{
            $produccionIngresos = ProduccionIngreso::
            where(['produccion_ingresos.estado'=>'Habilitado'])
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('produccion.tabla',compact('produccionIngresos'))->render();
            return response()->json(['html'=>$view]);
        }
    }

    public function reporteDetalle($id){
        set_time_limit(120);
        $produccionIngreso = ProduccionIngreso::find($id);
        $lote = Lote::with('agricultor','empresa','variedad','procedencia','chofer','vehiculo')->find($produccionIngreso->lote->id);
        $view = View::make('produccion.reporte.detalle',compact('lote','produccionIngreso'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
//        return view('lote.reporte.detalle',compact('lote'));
    }

    public function cambiarConformidad(Request $request)
    {
        $produccionProduccion = ProduccionIngreso::find($request['id']);

        $produccionProduccion->conforme = true;

        $produccionProduccion->save();

        if($produccionProduccion->conforme){
            foreach ($produccionProduccion->nuevaProduccion as $nuevaProduccion){
                foreach ($nuevaProduccion->resultadoProduccion as $resultadoProduccion){

                    $stockProducto = StockProductoItem::where('descripcion_producto',$resultadoProduccion->producto)->get()->first();

                    StockResultadoProduccion::create([
                       'stock_producto_id'=>$stockProducto->id,
                        'lote_id'=>$produccionProduccion->lote_id,
                        'produccion_ingreso_id'=>$produccionProduccion->id,
                        'nueva_produccion_id'=>$nuevaProduccion->id,
                        'resultado_producion_id'=>$resultadoProduccion->id,
                        'cantidad_inicial'=>$resultadoProduccion->nro_sacos,
                        'cantidad_stock'=>$resultadoProduccion->nro_sacos,
                        'kilos'=>$resultadoProduccion->kilos,
                        'estado_stock'=>false,
                        'fecha_registro'=>Carbon::now(),
                        'hora_registro'=>Carbon::now(),
                        'estado'=>"Habilitado"
                    ]);


                    $buscarLiquidacion = Liquidacion::where('lote_id',$produccionProduccion->lote_id)->get();

                    if($buscarLiquidacion->count() > 0){

                    }else{
                        $liquidacion = Liquidacion::orderBy('serie_liquidacion','desc')->first();
                        //dd($liquidacion);
                        Liquidacion::create([
                            'serie_liquidacion'=>isset($liquidacion)? $liquidacion->generarSerieGuia():'LIQ-000001',
                            'lote_id'=>$produccionProduccion->lote_id,
                            'estado_liquidacion'=>false,
                            'fecha_registro'=>Carbon::now(),
                            'estado'=>'Habilitado'
                        ]);
                    }
                }
            }
        }

        return response()->json(
            ['exito'=>true]
        );

    }


}
