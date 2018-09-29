<?php

namespace App\Http\Controllers;

use App\NuevaProduccion;
use App\ProduccionIngreso;
use App\ResultadoProducion;
use Illuminate\Http\Request;
use View;

class NuevaProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $ingresoProduccion = ProduccionIngreso::find($id);

        $nuevaProducciones = NuevaProduccion::where(['estado'=>'Habilitado','produccion_ingreso_id'=>$id])
            ->orderBy('fecha','desc')
            ->orderBy('hora','desc')
            ->paginate(10);

        return view('nuevaproduccion.index',compact('nuevaProducciones','ingresoProduccion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $ingresoProduccion = ProduccionIngreso::find($id);

        $nuevaProduccion = NuevaProduccion::where('estado','=','Habilitado')->get()->last();

        return view('nuevaproduccion.create',compact('ingresoProduccion','nuevaProduccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request['items']);

        if(request()->ajax()) {
            $data = request()->validate([
                'ingreso_produccion_id' => 'required',
                'nro_guia_nueva_produccion' => 'required',
                'nro_sacos_stock_inicial'=>'required',
                'kilos_totales_stock_inicial'=>'required',
                'kilo_por_sacos'=>'required',
                'nro_sacos_procesar'=>'required|numeric|min:1',
                'kilos_sacos_procesar'=>'required',
                'nro_sacos_saldo'=>'required',
                'kilos_sacos_saldo'=>'required'
            ]);

            $nuevaProduccion = NuevaProduccion::create([
                'produccion_ingreso_id' => $data['ingreso_produccion_id'],
                'nro_guia_salida' => $data['nro_guia_nueva_produccion'],
                'nro_sacos_stock_inicial' => $data['nro_sacos_stock_inicial'],
                'kilos_total_inicial' => $data['kilos_totales_stock_inicial'],
                'nro_sacos_a_procesar' => $data['nro_sacos_procesar'],
                'kilos_a_procesar'=> $data['kilos_sacos_procesar'],
                'nro_sacos_saldo'=> $data['nro_sacos_saldo'],
                'kilos_total_saldo'=> $data['kilos_sacos_saldo'],
                'fecha'=>\Carbon\Carbon::now()->toDateTimeString(),
                'hora'=>\Carbon\Carbon::now()->toTimeString(),
                'estado' => 'Habilitado'
            ]);

            foreach ($request['items'] as $item)
            {
                ResultadoProducion::create([
                   'producto'=>$item['producto'],
                   'nro_sacos'=>$item['nroSacos'],
                   'kilos'=>$item['sacosKilos'],
                   'precio_maquila'=>$item['precioMaquila'],
                   'sub_total_maquila'=>$item['subTotal'],
                   'nro_envases'=>$item['nroEnvases'],
                   'envase'=>$item['envase'],
                   'precio_envase'=>$item['precioEnvase'],
                   'sub_total_envase'=>$item['subTotalEnvases'],
                   'adicional'=>$item['adicional'],
                   'sub_total_adicional'=>$item['subTotalAdicional'],
                   'nueva_produccion_id'=>$nuevaProduccion->id,
                   'estado'=>'Habilitado'
                ]);
            }

            if($nuevaProduccion->nro_sacos_saldo == 0){
                $ingresoProduccion = ProduccionIngreso::find($nuevaProduccion->produccion_ingreso_id);
                $ingresoProduccion->estado_prod_ingreso = "terminado";
                $ingresoProduccion->save();
            }

            return response()->json(['mensaje' => 'registro exitoso']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NuevaProduccion  $nuevaProduccion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nuevaProduccion = NuevaProduccion::with('resultadoProduccion','ingresoProduccion')->find($id);
        return response()->json(
            $nuevaProduccion->toArray()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NuevaProduccion  $nuevaProduccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nuevaProduccion = NuevaProduccion::find($id);
        return view('nuevaproduccion.edit',compact('nuevaProduccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NuevaProduccion  $nuevaProduccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $data = request()->validate([
            'nueva_produccion_id'=>'required',
            'nro_sacos_stock_inicial'=>'required',
            'kilos_totales_stock_inicial'=>'required',
            'kilo_por_sacos'=>'required',
            'nro_sacos_procesar'=>'required|numeric|min:1',
            'kilos_sacos_procesar'=>'required',
            'nro_sacos_saldo'=>'required',
            'kilos_sacos_saldo'=>'required'
        ]);

        $nuevaProduccion = NuevaProduccion::find($data['nueva_produccion_id']);

        $nuevaProduccion->update([
            'nro_sacos_stock_inicial' => $data['nro_sacos_stock_inicial'],
            'kilos_total_inicial' => $data['kilos_totales_stock_inicial'],
            'nro_sacos_a_procesar' => $data['nro_sacos_procesar'],
            'kilos_a_procesar'=> $data['kilos_sacos_procesar'],
            'nro_sacos_saldo'=> $data['nro_sacos_saldo'],
            'kilos_total_saldo'=> $data['kilos_sacos_saldo']
        ]);

        $nuevaProduccion->save();

        ResultadoProducion::where('nueva_produccion_id',$nuevaProduccion->id)->delete();

        foreach ($request['items'] as $item)
        {
            ResultadoProducion::create([
                'producto'=>$item['producto'],
                'nro_sacos'=>$item['nroSacos'],
                'kilos'=>$item['sacosKilos'],
                'precio_maquila'=>$item['precioMaquila'],
                'sub_total_maquila'=>$item['subTotal'],
                'nro_envases'=>$item['nroEnvases'],
                'envase'=>$item['envase'],
                'precio_envase'=>$item['precioEnvase'],
                'sub_total_envase'=>$item['subTotalEnvases'],
                'adicional'=>$item['adicional'],
                'sub_total_adicional'=>$item['subTotalAdicional'],
                'nueva_produccion_id'=>$data['nueva_produccion_id'],
                'estado'=>'Habilitado'
            ]);
        }

        if($nuevaProduccion->nro_sacos_saldo == 0){
            $ingresoProduccion = ProduccionIngreso::find($nuevaProduccion->produccion_ingreso_id);
            $ingresoProduccion->estado_prod_ingreso = "terminado";
            $ingresoProduccion->save();
        }else{
            $ingresoProduccion = ProduccionIngreso::find($nuevaProduccion->produccion_ingreso_id);
            $ingresoProduccion->estado_prod_ingreso = "en proceso";
            $ingresoProduccion->save();
        }

        return response()->json(['mensaje' => "actualización exitosa"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NuevaProduccion  $nuevaProduccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $nuevaProduccion = NuevaProduccion::find($request['id']);

        $nuevaProduccion->update([
            'estado'=>'Inhabilitado'
        ]);

        $nuevaProduccion->save();

        $ingresoProduccion = ProduccionIngreso::find($nuevaProduccion->produccion_ingreso_id);

        $ultimoIngresoProduccion = NuevaProduccion::where('estado','Habilitado')
                                    ->where('produccion_ingreso_id',$ingresoProduccion->id)
                                    ->orderBy('fecha','desc')->orderBy('hora','desc')->first();

        if(isset($ultimoIngresoProduccion)){
            if($ultimoIngresoProduccion->nro_sacos_saldo > 0){
                $ingresoProduccion->estado_prod_ingreso = "en proceso";
                $ingresoProduccion->save();
            }
        }

        return response()->json([
            'mensaje'=>"eliminación exitosa"
        ]);
    }

    public function reporteDetalle($id){
        $nuevoIngreso = NuevaProduccion::find($id);
        $view = View::make('nuevaproduccion.reporte.detalle',compact('nuevoIngreso'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }

    public function search(Request $request){
        $lotes = null;
        //dd($request['id']);

        if($request['buscar'] != '') {
            $nuevaProducciones = NuevaProduccion::where('estado','Habilitado')
                ->where('nro_guia_salida','like','%'.$request['buscar'].'%')
                ->where('produccion_ingreso_id',$request['id'])
                ->orderBy('fecha', 'desc')
                ->orderBy('hora', 'desc')
                ->paginate(10);
        }else{
            $nuevaProducciones = NuevaProduccion::where(['estado'=>'Habilitado','produccion_ingreso_id'=>$request['id']])
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->paginate(10);
        }

        //dd($nuevaProducciones);

        if($request->ajax())
        {
            $view = view('nuevaproduccion.tabla',compact('nuevaProducciones'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
