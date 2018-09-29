<?php

namespace App\Http\Controllers;

use App\ResponsableCuadrilla;
use Illuminate\Http\Request;
class ResponsableCuadrillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responsables = ResponsableCuadrilla::where(['estado'=>'Habilitado'])->paginate(10);

        return view('responsables.index',compact('responsables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('responsables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(request()->ajax())
        {
            $data = request()->validate([
                'apellidos'=>'required',
                'nombres'=>'required',
                'dni'=>'required|unique:responsable_cuadrillas,dni|min:8|unique:personales,dni',
                'celular'=>'nullable|unique:responsable_cuadrillas'
            ],[
                'apellidos.required'=>'El campo apellido es obligatorio',
                'nombres.required'=>'El campo nombres es obligatorio',
                'dni.required'=>'El campo dni es obligatorio',
                'celular.unique'=>'El campo celular ya existe'
            ]);

            ResponsableCuadrilla::create([
                'apellidos'=>$data['apellidos'],
                'nombres'=>$data['nombres'],
                'dni'=>$data['dni'],
                'celular'=>$data['celular'],
                'estado'=>'Habilitado'
            ]);
            return response()->json(['mensaje'=>'registro exitoso']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResponsableCuadrilla  $responsableCuadrilla
     * @return \Illuminate\Http\Response
     */
    public function show(ResponsableCuadrilla $responsableCuadrilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResponsableCuadrilla  $responsableCuadrilla
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $responsable = ResponsableCuadrilla::find($id);

        return response()->json(
            $responsable->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResponsableCuadrilla  $responsableCuadrilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResponsableCuadrilla $responsableCuadrilla)
    {
        $responsable = ResponsableCuadrilla::find($request['id']);

        $data = request()->validate([
            'apellidos'=>'required',
            'nombres'=>'required',
            'dni'=>'required|min:8|unique:responsable_cuadrillas,dni,'.$responsable->dni.',dni|unique:personales,dni,'.$responsable->dni.',dni',
            'celular'=>'nullable|unique:responsable_cuadrillas,celular,'.$responsable->celular.',celular'
        ],[
            'apellidos.required'=>'El campo apellido es obligatorio',
            'nombres.required'=>'El campo nombres es obligatorio',
            'dni.required'=>'El campo dni es obligatorio',
            'celular.unique'=>'El campo celular ya existe',
        ]);

        $responsable->update([
            'apellidos'=>$data['apellidos'],
            'nombres'=>$data['nombres'],
            'dni'=>$data['dni'],
            'celular'=>$data['celular']
        ]);

        $responsable->save();


        return response()->json([
            'mensaje'=>$responsable->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResponsableCuadrilla  $responsableCuadrilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $responsable = ResponsableCuadrilla::find($request['id']);

        $responsable->update([
            'estado'=>'Inhabilitado'
        ]);

        $responsable->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $responsables = null;
        if($request['buscar'] != '')
        {
            $responsables = ResponsableCuadrilla::where('apellidos','like','%'.$request['buscar'].'%')
                ->orWhere('dni','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $responsables = ResponsableCuadrilla::where('estado','Habilitado')->paginate(10);
        }

        if($request->ajax())
        {
            $view = view('responsables.tabla',compact('responsables'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
