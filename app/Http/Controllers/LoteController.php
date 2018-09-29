<?php

namespace App\Http\Controllers;

use App\Agricultor;
use App\Chofer;
//use App\Cliente;
use App\Empresa;
use App\Lote;

use App\LoteSecado;
use App\Notifications\NewSecado;
use App\Notifications\NewIngresoProduccion;
use App\Procedencia;
use App\ProduccionIngreso;
use App\User;
use App\Variedad;
use App\Vehiculo;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use View;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $lotes = Lote::where(['lotes.estado'=>'Habilitado'])
            ->orderBy('fecha','desc')
            ->orderBy('hora','desc')
            ->paginate(10);

        return view('lote.index',compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $agricultores = Agricultor::select(DB::raw("CONCAT(apellidos,' ',nombres,' ',dni) as nombres_completos"),'id')
        $agricultores = Agricultor::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('nombres_completos','id')->toArray();

//        $clientes =Cliente::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
//            ->where('estado','=','Habilitado')
//            ->get()->pluck('nombres_completos','id')->toArray();

        $empresas =Empresa::select(DB::raw("razon_social"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('razon_social','id')->toArray();


        $variedades =Variedad::select('descripcion','id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('descripcion','id')->toArray();

        $procedencias =Procedencia::select('lugar','id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('lugar','id')->toArray();

        $choferes =Chofer::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('nombres_completos','id')->toArray();

        $vehiculos =Vehiculo::select(DB::raw("CONCAT(marca,' ',descripcion,' ',placa) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->get()->pluck('nombres_completos','id')->toArray();

        $lote = Lote::where('estado','=','Habilitado')->get()->last();
        return view('lote.create',compact('lote','agricultores','empresas','variedades','procedencias','choferes','vehiculos'));
    }


    public function store()
    {
        if(request()->ajax())
        {
            //dd($request);
            //$data = request()->toArray();
            $data = request()->validate([
                'campania'=>'required',
                'nro_guia'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'optradio'=>'nullable',
                'agricultor'=>'required_if:optradio,==,agricultor',
                //'cliente'=>'required_if:optradio,==,cliente',
                'empresa'=>'required_if:optradio,==,empresa',

                'chofer'=>'required',
                'fletexPeso'=>'nullable',

                'fletexSaco'=>'nullable',
                'fletexTonelada'=>'nullable',
                'fletexTotal'=>'nullable',

                'kilos'=>'required_if:optradio,==,sacos',
                'nro_sacos'=>'required_if:optradio,==,sacos',
                'pesoreal'=>'required_if:optradio,==,sacos',

                'kilos_nro_sacos'=>'required_if:optradio,==,kilos',
                'kilos_kilos'=>'required_if:optradio,==,kilos',
                'kilos_pesoreal'=>'required_if:optradio,==,kilos',

                'nro_sacos_mayor_13'=>'nullable',
                'nro_sacos_menor_13'=>'nullable',

                'pagadopor'=>'required',
                'procedencia'=>'required',

                'rbtipoPeso'=>'nullable',
                'rbtipoflete'=>'nullable',

                'variedad'=>'required',
                'vehiculo'=>'required',
                'observacion'=>'nullable',
                'nro_sacos_mayor_13'=>'numeric|min:1',
                'nro_sacos_menor_13'=>'numeric|min:1'
            ],[
                'campania.required'=>'El campo campaña es obligatorio',
                'nombres.required'=>'El campo nombres es obligatorio',
                'chofer.required'=>'El campo chofer es obligatorio',
                'fecha.required'=>'El campo fecha es obligatorio',
                'hora.required'=>'El campo hora es obligatorio',
                'pagadopor.required'=>'El campo pagadopor es obligatorio',
                'procedencia.required'=>'El campo procedencia es obligatorio',
                'vehiculo.required'=>'El campo vehiculo es obligatorio'
            ]);

            $nro_sacos = 0;
            $kilos = 0;
            $pesoReal = 0;
            if($data['rbtipoPeso'] == 'sacos')
            {
                $nro_sacos = $data['nro_sacos'];
                $kilos = $data['kilos'];
                $pesoReal = $data['pesoreal'];
            }else if($data['rbtipoPeso'] == 'kilos')
            {
                $nro_sacos = $data['kilos_nro_sacos'];
                $kilos = $data['kilos_kilos'];
                $pesoReal = $data['kilos_pesoreal'];
            }

            Lote::create([
                'compania'=>$data['campania'],
                'nro_guia'=>$data['nro_guia'],
                'fecha'=>$data['fecha'],
                'hora'=>$data['hora'],
                'tipo_recepcion'=>$data['optradio'],
                'tipo_peso'=>$data['rbtipoPeso'],

                'nro_sacos'=>$nro_sacos,
                'kilos'=>$kilos,
                'peso_real'=>$pesoReal,
                'tipo_flete'=>$data['rbtipoflete'],
                'pagado_por'=>$data['pagadopor'],

                'flete_x_saco'=>$data['fletexSaco'],
                'flete_x_peso'=>$data['fletexPeso'],
                'flete_x_tonelada'=>$data['fletexTonelada'],
                'flete_total'=>$data['fletexTotal'],
                'nro_humedad_mayor_13'=>$data['nro_sacos_mayor_13'],

                'nro_humedad_menor_13'=>$data['nro_sacos_menor_13'],
                'observacion'=>$data['observacion'],
                'conforme'=>false,
                'personal_id'=>Auth::user()->id,
                'vehiculo_id'=>$data['vehiculo'],
                'chofer_id'=>$data['chofer'],
                'procedencia_id'=>$data['procedencia'],
                //'cliente_id'=>$data['cliente'],
                'agricultor_id'=>$data['agricultor'],
                'empresa_id'=>$data['empresa'],
                'variedad_id'=>$data['variedad'],
                'estado'=>'Habilitado'
            ]);

            return response()->json(['mensaje' => $data]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lote  $lote
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
     * @param  \App\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function edit(Lote $lote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lote  $lote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $lote = Lote::find($request['id']);

        $lote->update([
            'estado'=>'Inhabilitado'
        ]);

        $lote->save();

        return response()->json([
            'mensaje'=>"eliminación exitosa"
        ]);
    }

    public function listarCliente(Request $request)
    {
        // $term = $request->term ?:'';
        // $clientes =Cliente::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
        //     ->where('estado','=','Habilitado')
        //     ->where('apellidos','like','%'.$term.'%')
        //     ->orWhere('nombres','like','%'.$term.'%')
        //     ->orWhere('dni','like','%'.$term.'%')
        //     ->get()->pluck('nombres_completos','id')->toArray();
        //
        // $listacliente = [];
        // foreach ($clientes as $id => $tag){
        //     $listacliente[] = ['id'=>$id,'text'=>$tag];
        // }
        //
        // return response()->json(
        //     $listacliente
        // );
    }

    public function listarAgricultor(Request $request)
    {
        $term = $request->term ?:'';
//        $agricultores =Agricultor::select(DB::raw("CONCAT(apellidos,' ',nombres,' ',dni) as nombres_completos"),'id')
        $agricultores =Agricultor::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->where('apellidos','like','%'.$term.'%')
            //->orWhere('nombres','like','%'.$term.'%')
            ->orWhere('dni','like','%'.$term.'%')
            ->orWhere('ruc','like','%'.$term.'%')
            ->get()->pluck('nombres_completos','id')->toArray();

        $listarsagricultor = [];
        foreach ($agricultores as $id => $tag){
            $agricultor = Agricultor::find($id);
            if($agricultor->estado == 'Habilitado'){
                $listarsagricultor[] = ['id'=>$id,'text'=>$tag];
            }

        }

        return response()->json(
            $listarsagricultor
        );
    }

    public function listarEmpresa(Request $request)
    {
        $term = $request->term ?:'';
        $empresas =Empresa::select(DB::raw("razon_social"),'id')
            ->where('estado','=','Habilitado')
            ->where('razon_social','like','%'.$term.'%')
            ->orWhere('ruc','like','%'.$term.'%')
            ->get()->pluck('razon_social','id')->toArray();

        $listaempresa = [];
        foreach ($empresas as $id => $tag){
            $empresa = Empresa::find($id);
            if($empresa->estado == 'Habilitado')
            {
                $listaempresa[] = ['id'=>$id,'text'=>$tag];
            }
        }

        return response()->json(
            $listaempresa
        );
    }

    public function listarVariedad(Request $request)
    {
        $term = $request->term ?:'';
        $variedad =Variedad::select('descripcion','id')
            ->where('estado','=','Habilitado')
            ->where('descripcion','like','%'.$term.'%')
            ->get()->pluck('descripcion','id')->toArray();

        $listarvariedad = [];
        foreach ($variedad as $id => $tag){
            $variedad = Variedad::find($id);
            if($variedad->estado == 'Habilitado'){
                $listarvariedad[] = ['id'=>$id,'text'=>$tag];
            }
        }

        return response()->json(
            $listarvariedad
        );
    }

    public function listarProcedencia(Request $request)
    {
        $term = $request->term ?:'';
        $procedencia =Procedencia::select('lugar','id')
            ->where('estado','=','Habilitado')
            ->where('lugar','like','%'.$term.'%')
            ->get()->pluck('lugar','id')->toArray();

        $listarprocedencia = [];
        foreach ($procedencia as $id => $tag){
            $pro = Procedencia::find($id);
            if($pro->estado == 'Habilitado'){
                $listarprocedencia[] = ['id'=>$id,'text'=>$tag];
            }
        }

        return response()->json(
            $listarprocedencia
        );
    }

    public function listarChofer(Request $request)
    {
        $term = $request->term ?:'';
        $chofer =Chofer::select(DB::raw("CONCAT(apellidos,' ',nombres) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->where('apellidos','like','%'.$term.'%')
            //->orWhere('nombres','like','%'.$term.'%')
            ->orWhere('dni','like','%'.$term.'%')
            ->get()->pluck('nombres_completos','id')->toArray();

        $listarchofer = [];
        foreach ($chofer as $id => $tag){
            $cho = Chofer::find($id);
            if($cho->estado == 'Habilitado'){
                $listarchofer[] = ['id'=>$id,'text'=>$tag];
            }
        }

        return response()->json(
            $listarchofer
        );
    }

    public function listarVehiculo(Request $request)
    {
        $term = $request->term ?:'';
        $vehiculo =Vehiculo::select(DB::raw("CONCAT(marca,' ',descripcion,' ',placa) as nombres_completos"),'id')
            ->where('estado','=','Habilitado')
            ->where('placa','like','%'.$term.'%')
            ->get()->pluck('nombres_completos','id')->toArray();

        $listarvehiculo = [];
        foreach ($vehiculo as $id => $tag){
            $vehi = Vehiculo::find($id);
            if($vehi->estado == 'Habilitado'){
                $listarvehiculo[] = ['id'=>$id,'text'=>$tag];
            }
        }

        return response()->json(
            $listarvehiculo
        );
    }

    public function reporteDetalle($id){

        $lote = Lote::with('agricultor','empresa','variedad','procedencia','chofer','vehiculo')->find($id);
        $view = View::make('lote.reporte.detalle',compact('lote'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->stream($view);
        return $pdf->stream();
//        return view('lote.reporte.detalle',compact('lote'));
    }

    public function cambiarConformidad(Request $request)
    {
        $lote = Lote::find($request['id']);

        $lote->conforme = true;

        $lote->save();

        if($lote->nro_humedad_mayor_13 > 0)
        {
            $loteSecadoExiste = LoteSecado::where('lote_id',$lote->id)->get();
            $loteSecadoAnterior = LoteSecado::where('estado','Habilitado')->get()->last();
            $nroSerie = "";


            if($loteSecadoExiste->isEmpty()){
                if(isset($loteSecadoAnterior)){
                    $nroSerie = $loteSecadoAnterior->generarSerieGuia();
                }else{
                    $nroSerie = "SEC-000001";
                }
                $loteSecado = LoteSecado::create([
                    'lote_id'=>$lote->id,
                    'nro_serie_guia'=>$nroSerie,
                    'estado_secado'=>'en proceso',
                    'conforme'=>false,
                    'fecha'=>Carbon::now(),
                    'hora'=>Carbon::now(),
                    'estado'=>'Habilitado'
                ]);

                $usuario = User::all()->where('area_id','3');
                Notification::send($usuario,new NewSecado($loteSecado));
            }
            /*else{
                return response()->json(
                    ['exito'=>false]
                );
            }*/
        }

        if($lote->nro_humedad_menor_13 > 0){
            $produccionAnterior = ProduccionIngreso::where('estado','Habilitado')->get()->last();

            $produccionIngresoExiste = ProduccionIngreso::where('lote_id',$lote->id)->get();

            $nuevaSerie = "";
            if($produccionIngresoExiste->isEmpty()){

                if($produccionAnterior != null){
                    $nuevaSerie = $produccionAnterior->generarSerieGuia();
                }else{
                    $nuevaSerie = 'PROD-000001';
                }

                $produccionIngreso = ProduccionIngreso::create([
                    'nro_guia_ingreso'=>$nuevaSerie,
                    'lote_id'=>$lote->id,
                    'estado_prod_ingreso'=>'en proceso',
                    'nro_sacos_ingresados'=>$lote->nro_humedad_menor_13,
                    'kilo_por_saco'=>$lote->kilos,
                    'area_origen'=>'Recepción',
                    'conforme'=>false,
                    'fecha'=>Carbon::now(),
                    'hora'=>Carbon::now(),
                    'estado'=>'Habilitado'
                ]);

                $usuario = User::all()->where('area_id','4');
                Notification::send($usuario,new NewIngresoProduccion($produccionIngreso));

                //$produccionIngreso->save();

            }
        }

        return response()->json(
            ['exito'=>true]
        );

    }

    public function search(Request $request){

        $lotes = null;
        //dd($request['filtro']);

        if($request['buscar'] != '')
        {
            if($request['filtro'] == "guia") {
                $lotes = Lote::select('lotes.*')->leftjoin('agricultores', 'lotes.agricultor_id', '=', 'agricultores.id')
                    //->leftjoin('clientes', 'lotes.cliente_id', '=', 'clientes.id')
                    ->leftjoin('empresas', 'lotes.empresa_id', '=', 'empresas.id')
                    ->where('lotes.nro_guia', 'like', '%' . $request['buscar'] . '%')
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc');

                $lotes = $lotes->where('lotes.estado', 'Habilitado')->paginate(10);
            }elseif($request['filtro'] == "persona")
            {
                $lotes = Lote::select('lotes.*')->leftjoin('agricultores', 'lotes.agricultor_id', '=', 'agricultores.id')
                    ->where('agricultores.apellidos','like','%'.$request['buscar'].'%')
                    ->orWhere('agricultores.dni','like','%'.$request['buscar'].'%')
                    ->orWhere('agricultores.ruc','like','%'.$request['buscar'].'%')
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc')->paginate(10);


                //$lotes = $lotes->where('lotes.estado', 'Habilitado')->paginate(10);
            }elseif($request['filtro'] == "empresa"){
                $lotes = Lote::select('lotes.*')->leftjoin('agricultores', 'lotes.agricultor_id', '=', 'agricultores.id')
                    //->leftjoin('clientes', 'lotes.cliente_id', '=', 'clientes.id')
                    ->leftjoin('empresas', 'lotes.empresa_id', '=', 'empresas.id')
                    ->orWhere('empresas.razon_social','like','%'.$request['buscar'].'%')
                    ->orWhere('empresas.ruc','like','%'.$request['buscar'].'%')
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc');

                $lotes = $lotes->where('lotes.estado', 'Habilitado')->paginate(10);
            }
        }else{
            $lotes = Lote::where(['lotes.estado'=>'Habilitado'])
                ->orderBy('fecha','desc')
				->orderBy('hora','desc')
                ->paginate(10);
        }
        if($request->ajax())
        {
            $view = view('lote.tabla',compact('lotes'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
