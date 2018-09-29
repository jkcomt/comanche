<?php

namespace App\Http\Controllers;

use App\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $almacenes = Almacen::where(['estado'=>'Habilitado'])->paginate(10);

        return view('almacen.index',compact('almacenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->ajax()) {
            $data = request()->validate([
                'nombre' => 'required'
            ], [
                'nombre.required' => 'El campo nombre es obligatorio'
            ]);

            Almacen::create([
                'nombre' => $data['nombre'],
                'estado'=>'Habilitado'
            ]);

            return response()->json(['mensaje' => 'registro exitoso']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Almacen $almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $almacen = Almacen::find($id);

        return response()->json(
            $almacen->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $almacen = Almacen::find($request['id']);

        $data = request()->validate([
            'nombre'=>'required'
        ],[
            'nombre.required'=>'El campo nombre es obligatorio'
        ]);

        $almacen->update([
            'nombre'=>$data['nombre']
        ]);

        $almacen->save();


        return response()->json([
            'mensaje'=>$almacen->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Almacen  $almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $almacen = Almacen::find($request['id']);

        $almacen->update([
            'estado'=>'Inhabilitado'
        ]);

        $almacen->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }
}
