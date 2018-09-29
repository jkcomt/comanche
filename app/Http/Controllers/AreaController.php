<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::where(['estado'=>'Habilitado'])->paginate(10);

        return view('area.index',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('area.create');
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
                'descripcion' => 'required|alpha|regex:/(^([a-z]+)(\d+)?$)/u'
            ], [
                'descripcion.required' => 'El campo descripcion es obligatorio'
            ]);

            Area::create([
                'descripcion' => $data['descripcion'],
                'estado'=>'Habilitado'
            ]);

            return response()->json(['mensaje' => 'registro exitoso']);
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
        $area = Area::find($id);

        return response()->json(
            $area->toArray()
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
        $area = Area::find($request['id']);

        $data = request()->validate([
            'descripcion'=>'required|alpha|regex:/(^([a-z]+)(\d+)?$)/u'
        ],[
            'descripcion.required'=>'El campo descripcion es obligatorio'
        ]);

        $area->update([
            'descripcion'=>$data['descripcion']
        ]);

        $area->save();


        return response()->json([
            'mensaje'=>$area->toArray()
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
        $area = Area::find($request['id']);

        $area->update([
            'estado'=>'Inhabilitado'
        ]);

        $area->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }
}
