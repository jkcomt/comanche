<?php

namespace App\Http\Controllers;

use App\LoteSecado;
use App\Recojo;
use App\ResponsableCuadrilla;
use App\Tendido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;
class TendidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tendidos = Tendido::where(['estado'=>'Habilitado','lote_secado_id'=>$id])
            ->orderBy('fecha','desc')
            ->orderBy('hora','desc')
            ->paginate(10);

        $loteSecado = LoteSecado::find($id);
        /*$loteSecado = DB::table('recojos')->join('tendidos','recojos.tendido_id','=','tendidos.id')
            ->join('lote_secados','tendidos.lote_secado_id','=','lote_secados.id')
            ->where('lote_secados.id','=',$id)
            ->sum('recojos.peso_recogidos');*/

        return view('tendido.index',compact('tendidos','loteSecado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $loteSecado = LoteSecado::find($id);
        $tendido = Tendido::where('estado','=','Habilitado')->get()->last();

        //dd($loteSecado->tendido->where('estado','Habilitado')->isEmpty());

        $responsables =ResponsableCuadrilla::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('nombres_completos','id')->toArray();

        return view('tendido.create',compact('loteSecado','tendido','responsables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(request()->ajax()){
            $data = request()->validate([
                'lote_secado'=>'required',
                'nro_guia_tendido'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'responsable'=>'required',
                'sacos_pendientes'=>'required',
                'kilos_pendientes'=>'required',
                'sacos_secar'=>'required|numeric|min:1',
                'kilos_secar'=>'required',
                'sacos_restantes'=>'required',
                'kilos_restantes'=>'required',
                'observacion'=>'nullable',
                ]
                );

            $tendido = Tendido::create([
                'nro_guia_tendido'=>$data['nro_guia_tendido'],
                'fecha'=>$data['fecha'],
                'hora'=>$data['hora'],
                'nro_sacos_pre_secado'=>$data['sacos_pendientes'],
                'kilos_pre_secado'=>$data['kilos_pendientes'],
                'nro_sacos_a_secar'=>$data['sacos_secar'],
                'kilos_a_secar'=>$data['kilos_secar'],
                'nro_sacos_no_secado'=>$data['sacos_restantes'],
                'kilos_no_secado'=>$data['kilos_restantes'],
                'observacion'=>$data['observacion'],
                'estado'=>'Habilitado',
                'lote_secado_id'=>$data['lote_secado'],
                'responsable_id'=>$data['responsable'],
                'estado_tendido'=>'en proceso'
            ]);

//            if($tendido->nro_sacos_no_secado == 0){
//                $loteSecado = LoteSecado::find($tendido->lote_secado_id);
//                $loteSecado->estado_secado = 'terminado';
//                $loteSecado->save();
//            }

            return response()->json(['mensaje' => $data]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tendido  $tendido
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tendido = Tendido::with('loteSecado.lote.agricultor','loteSecado.lote.variedad','responsable')->find($id);

        return response()->json(
            $tendido->toArray()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tendido  $tendido
     * @return \Illuminate\Http\Response
     */
    public function edit(Tendido $tendido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tendido  $tendido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tendido $tendido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tendido  $tendido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tendido = Tendido::find($request['id']);

        $tendido->update([
            'estado'=>'Inhabilitado'
        ]);

        $tendido->save();

        $recojos = Recojo::where('estado','Habilitado')->where('tendido_id',$tendido->id);

        $recojos->update([
            'estado'=>'Inhabilitado'
        ]);

        return response()->json([
            'mensaje'=>"eliminación exitosa"
        ]);
    }

    public function listarResponsable(Request $request)
    {
        $term = $request->term ?:'';
        $responsable = ResponsableCuadrilla::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id as cod')
            ->where('estado','=','Habilitado')
            ->where('apellidos','like','%'.$term.'%')
            ->orWhere('dni','like','%'.$term.'%')
            ->get()->pluck('nombres_completos','cod')->toArray();

        $listarresponsable = [];
        foreach ($responsable as $cod => $tag){
            $listarresponsable[] = ['id'=>$cod,'text'=>$tag];
        }

        return response()->json(
            $listarresponsable
        );
    }

    public function reporteDetalle($id)
    {
        $tendido = Tendido::with('loteSecado','responsable')->find($id);
        $view = View::make('tendido.reporte.detalle',compact('tendido'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }

    public function search(Request $request){

        $tendidos = null;
        if($request['buscar'] != '')
        {
            $tendidos = Tendido::where('estado','=','Habilitado')
                ->where('nro_guia_tendido','like','%'.$request['buscar'].'%')
                ->where('lote_secado_id','=',$request['lotesecado'])
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->paginate(10);
        }else{
            $tendidos = Tendido::where('estado','=','Habilitado')
                ->orderBy('fecha','desc')
                ->orderBy('hora','desc')
                ->where('lote_secado_id','=',$request['lotesecado'])->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('tendido.tabla',compact('tendidos'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
