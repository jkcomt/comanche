<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedencia;
class ProcedenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedencias = Procedencia::where(['estado'=>'Habilitado'])->paginate(10);

        return view('procedencia.index',compact('procedencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procedencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(request()->ajax()) {
            $data = request()->validate([
                'lugar' => 'required'
            ], [
                'lugar.required' => 'El campo descripcion es obligatorio'
            ]);

            Procedencia::create([
                'lugar' => $data['lugar'],
                'estado'=>'Habilitado'
            ]);

            return response()->json(['mensaje' => 'registro exitoso']);
        }else{
            return response()->json(['mensaje'=>'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedencia = Procedencia::find($id);

        return response()->json(
            $procedencia->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $procedencia = Procedencia::find($request['id']);

        $data = request()->validate([
            'lugar'=>'required'
        ],[
            'lugar.required'=>'El campo lugar es obligatorio'
        ]);

        $procedencia->update([
            'lugar'=>$data['lugar']
        ]);

        $procedencia->save();


        return response()->json([
            'mensaje'=>$procedencia->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $procedencia = Procedencia::find($request['id']);

        $procedencia->update([
            'estado'=>'Inhabilitado'
        ]);

        $procedencia->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $procedencias = null;
        if($request['buscar'] != '')
        {
            $procedencias = Procedencia::where('lugar','like','%'.$request['buscar'].'%')
                ->where('estado','Habilitado')->paginate(10);
        }else{
            $procedencias = Procedencia::where('estado','Habilitado')->paginate(10);
        }

        if($request->ajax())
        {
            $view = view('procedencia.tabla',compact('procedencias'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
