<?php

namespace App\Http\Controllers;

use App\LoteSecado;
use App\ProduccionIngreso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Notifications\NewIngresoProduccion;
use View;

class LoteSecadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $loteSecados =  LoteSecado::find(2);
//        //$secados = LoteSecado::where('id','=',$loteSecados->id-1)->get();
//
//        dd($loteSecados->accionesDisponibles());

        $loteSecados = LoteSecado::select('lote_secados.*')->where(['lote_secados.estado'=>'Habilitado'])
            ->join('lotes','lote_secados.lote_id','=','lotes.id')
            ->orderBy('lote_secados.fecha','desc')
            ->orderBy('lote_secados.hora','desc')
            ->paginate(10);

        return view('secado.index',compact('loteSecados'));
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
     * @param  \App\LoteSecado  $loteSecado
     * @return \Illuminate\Http\Response
     */
    public function show(LoteSecado $loteSecado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoteSecado  $loteSecado
     * @return \Illuminate\Http\Response
     */
    public function edit(LoteSecado $loteSecado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoteSecado  $loteSecado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoteSecado $loteSecado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoteSecado  $loteSecado
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoteSecado $loteSecado)
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
            return redirect('/secado');
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

        $loteSecados = null;
        if($request['buscar'] != '')
        {
            if($request['filtro'] == "guia") {

                $loteSecados = LoteSecado::select('lote_secados.*')->where(['lote_secados.estado'=>'Habilitado'])
                    ->join('lotes','lote_secados.lote_id','=','lotes.id')
                    ->where('lote_secados.nro_serie_guia','like','%'.$request['buscar'].'%')
                    ->orderBy('lotes.fecha','desc')
                    ->orderBy('lotes.hora','desc')
                    ->paginate(10);

            }elseif($request['filtro'] == "persona"){

                $loteSecados = LoteSecado::select('lote_secados.*')->where(['lote_secados.estado'=>'Habilitado'])
                    ->join('lotes','lote_secados.lote_id','=','lotes.id')
                    ->leftjoin('agricultores', 'lotes.agricultor_id', '=', 'agricultores.id')
                    ->where('agricultores.apellidos','like','%'.$request['buscar'].'%')
                    ->orWhere('agricultores.ruc','like','%'.$request['buscar'].'%')
                    ->orWhere('agricultores.dni','like','%'.$request['buscar'].'%')
                    ->orderBy('lotes.fecha','desc')
                    ->orderBy('lotes.hora','desc')
                    ->paginate(10);

            }elseif($request['filtro'] == "empresa"){
                $loteSecados = LoteSecado::select('lote_secados.*')->where(['lote_secados.estado'=>'Habilitado'])
                    ->join('lotes','lote_secados.lote_id','=','lotes.id')
                    ->leftjoin('empresas', 'lotes.empresa_id', '=', 'empresas.id')
                    ->where('empresas.razon_social','like','%'.$request['buscar'].'%')
                    ->orWhere('empresas.ruc','like','%'.$request['buscar'].'%')
                    ->orderBy('lotes.fecha','desc')
                    ->orderBy('lotes.hora','desc')
                    ->paginate(10);
            }


        }else{
            $loteSecados = LoteSecado::select('lote_secados.*')->where(['lote_secados.estado'=>'Habilitado'])
                ->join('lotes','lote_secados.lote_id','=','lotes.id')

                ->orderBy('lotes.fecha','desc')
                ->orderBy('lotes.hora','desc')
                ->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('secado.tabla',compact('loteSecados'))->render();
            return response()->json(['html'=>$view]);
        }
    }

    public function cambiarConformidad(Request $request)
    {
        $loteSecado = LoteSecado::find($request['id']);
        //dd($loteSecado);
        $loteSecado->conforme = true;

        $loteSecado->save();

        $produccionAnterior = ProduccionIngreso::where('estado','Habilitado')->get()->last();

        $produccionIngresoExiste = ProduccionIngreso::where('lote_secado_id',$loteSecado->id)->get();

        $nuevaSerie = "";

        if($produccionIngresoExiste->isEmpty()){

            if($produccionAnterior != null){
                $nuevaSerie = $produccionAnterior->generarSerieGuia();
            }else{
                $nuevaSerie = 'PROD-000001';
            }

            $produccionIngreso = ProduccionIngreso::create([
                'nro_guia_ingreso'=>$nuevaSerie,
                'lote_id'=>$loteSecado->lote->id,
                'lote_secado_id'=>$loteSecado->id,
                'estado_prod_ingreso'=>'en proceso',
                'nro_sacos_ingresados'=>$loteSecado->sumtatotalnrosacosrecogidos(),
                'kilo_por_saco'=>$loteSecado->lote->kilos,
                'conforme'=>false,
                'area_origen'=>'Secado',
                'fecha'=>Carbon::now(),
                'hora'=>Carbon::now(),
                'estado'=>'Habilitado'
            ]);

            $usuario = User::all()->where('area_id','4');
            Notification::send($usuario,new NewIngresoProduccion($produccionIngreso));

        }


        return response()->json(
            ['exito'=>true]
        );

       /* if($lote->nro_humedad_mayor_13 > 0)
        {
            $loteSecadoExiste = LoteSecado::where('lote_id',$lote->id)->get();
            //dd($loteSecadoExiste);
            if($loteSecadoExiste->isEmpty()){
                $loteSecado = LoteSecado::create([
                    'lote_id'=>$lote->id,
                    'estado_secado'=>'en proceso',
                    'conforme'=>false,
                    'estado'=>'Habilitado'
                ]);

                $usuario = User::all()->where('area_id','3');
                Notification::send($usuario,new NewSecado($loteSecado));

                return response()->json(
                    ['exito'=>true]
                );
            }else{
                return response()->json(
                    ['exito'=>false]
                );
            }


            //echo $usuario->id;

        }*/
    }

    public function reporteDetalle($id){
        $loteSecado = LoteSecado::find($id);
        $view = View::make('secado.reporte.detalle',compact('loteSecado'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
    }
}
