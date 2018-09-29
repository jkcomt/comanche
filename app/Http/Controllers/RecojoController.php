<?php

namespace App\Http\Controllers;

use App\Almacen;
use App\Recojo;
use App\Tendido;
use App\LoteSecado;
use Illuminate\Http\Request;
use View;
class RecojoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tendido = Tendido::find($id);
        $recojos = Recojo::where(['estado'=>'Habilitado','tendido_id'=>$id])
            ->orderBy('fecha','desc')
            ->orderBy('hora','desc')
            ->paginate(10);

        return view('recojo.index',compact('recojos','tendido'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tendido = Tendido::find($id);
        $recojo = Recojo::where('estado','=','Habilitado')->get()->last();

        //dd(isset($recojo));

        $almacenes = Almacen::where('estado','=','Habilitado')->get();

        return view('recojo.create',compact('recojo','tendido','almacenes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (request()->ajax()) {
            $data = request()->validate([
                    'nro_guia_recojo' => 'required',
                    'fecha_recojo' => 'required',
                    'hora_recojo' => 'required',

                    'nro_sacos_recogidos' => 'required|min:1',
                    'kilos_recogidos' => 'required',
                    'pesos_recogidos' => 'required',

                    'nro_sacos_no_recogidos' => 'required',
                    'kilos_no_recogidos' => 'required|min:0',
                    'peso_no_recogido' => 'required',

                    'importe_sacos' => 'required',
                    'importe_total' => 'required',
                    'humedad_al_recoger'=>'required',
                    'tendido'=>'required',

                    'almacen'=>'required',
                    'observacion' => 'nullable',
                ]
            );

            $recojo = Recojo::create([
                'nro_guia_recojo' => $data['nro_guia_recojo'],
                'fecha' => $data['fecha_recojo'],
                'hora' => $data['hora_recojo'],
                'nro_sacos_recogidos' => $data['nro_sacos_recogidos'],
                'kilos_recogidos' => $data['kilos_recogidos'],
                'peso_recogidos' => $data['pesos_recogidos'],

                'nro_sacos_no_recogidos' => $data['nro_sacos_no_recogidos'],
                'kilos_no_recogidos' => $data['kilos_no_recogidos'],
                'peso_no_recogido' => $data['peso_no_recogido'],

                'importe_sacos' => $data['importe_sacos'],
                'importe_total' => $data['importe_total'],
                'humedad_al_recoger' => $data['humedad_al_recoger'],

                'observacion' => $data['observacion'],
                'tendido_id'=>$data['tendido'],
                'almacen_id'=>$data['almacen'],
                'estado'=>'Habilitado'

            ]);


            //verifica el estado del lote secado terminado o en proceso
            if($recojo->nro_sacos_no_recogidos == 0){
                if($recojo->tendido->loteSecado->lote->nro_humedad_mayor_13 == $recojo->tendido->loteSecado->tendido->where('estado','Habilitado')->sum('nro_sacos_a_secar'))
                {
                    if($recojo->tendido->loteSecado->ultimoTendido()->id == $recojo->tendido->id)
                    {
                        $loteSecado = LoteSecado::find($recojo->tendido->lote_secado_id);
                        $loteSecado->estado_secado = 'terminado';
                        $loteSecado->save();
                    }
                }

                $tendido = $recojo->tendido;
                $tendido->estado_tendido = 'terminado';
                $tendido->save();

            }else{
                $loteSecado = LoteSecado::find($recojo->tendido->lote_secado_id);
                $loteSecado->estado_secado = 'en proceso';
                $loteSecado->save();
            }

            return response()->json(['mensaje' => $data]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recojo  $recojo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recojo = Recojo::with('almacen')->find($id);

        return response()->json(
            $recojo->toArray()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recojo  $recojo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recojo $recojo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recojo  $recojo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recojo $recojo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recojo  $recojo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $recojo = Recojo::find($request['id']);

        $recojo->update([
            'estado'=>'Inhabilitado'
        ]);

        $recojo->save();

        if($recojo->nro_sacos_no_recogidos == 0)
        {
            $loteSecado = LoteSecado::find($recojo->tendido->lote_secado_id);
            $loteSecado->estado_secado = 'en proceso';
            $loteSecado->save();

            $tendido = $recojo->tendido;
            $tendido->estado_tendido = 'en proceso';
            $tendido->save();
        }



        return response()->json([
            'mensaje'=>"eliminación exitosa"
        ]);
    }

    public function reporteDetalle($id)
    {
        $recojo = Recojo::with('tendido','almacen')->find($id);
        $view = View::make('recojo.reporte.detalle',compact('recojo'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }

    public function search(Request $request){

        $recojos = null;
        if($request['buscar'] != '')
        {
            $recojos = Recojo::where('estado','=','Habilitado')
                ->where('nro_guia_recojo','like','%'.$request['buscar'].'%')
                ->where('tendido_id','=',$request['tendidoid'])
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->paginate(10);
        }else{
            $recojos = Recojo::where('estado','=','Habilitado')
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->where('tendido_id','=',$request['tendidoid'])->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('recojo.tabla',compact('recojos'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
