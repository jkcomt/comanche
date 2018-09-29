<?php

namespace App\Http\Controllers;
use App\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::where(['estado'=>'Habilitado'])->paginate(10);

        return view('vehiculo.index',compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehiculo.create');
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
                'marca'=>'required',
                'descripcion'=>'required',
                'placa'=>'required|unique:vehiculos,placa'
            ],[
                'marca.required'=>'El campo marca es obligatorio',
                'descripcion.required'=>'El campo descripcion es obligatorio',
                'placa.required'=>'El campo placa es obligatorio',
            ]);

            Vehiculo::create([
                'marca'=>$data['marca'],
                'descripcion'=>$data['descripcion'],
                'placa'=>$data['placa'],
                'estado'=>'Habilitado'
            ]);

            return response()->json(['mensaje'=>'registro exitoso']);
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
        $vehiculo = Vehiculo::find($id);

        return response()->json(
            $vehiculo->toArray()
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
        $vehiculo = Vehiculo::find($request['id']);

        $data = request()->validate([
            'marca'=>'required',
            'descripcion'=>'required',
            'placa'=>'required|unique:vehiculos,placa,'.$vehiculo->placa.',placa',
        ],[
            'marca.required'=>'El campo marca es obligatorio',
            'descripcion.required'=>'El campo descripcion es obligatorio',
            'placa.required'=>'El campo placa es obligatorio',
        ]);

        $vehiculo->update([
            'marca'=>$data['marca'],
            'descripcion'=>$data['descripcion'],
            'placa'=>$data['placa']
        ]);

        $vehiculo->save();


        return response()->json([
            'mensaje'=>$vehiculo->toArray()
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
        $vehiculo = Vehiculo::find($request['id']);

        $vehiculo->update([
            'estado'=>'Inhabilitado'
        ]);

        $vehiculo->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $vehiculos = Vehiculo::where('placa','like','%'.$request['buscar'].'%')->where('estado','Habilitado')->paginate(10);

        if($request->ajax())
        {
            $view = view('vehiculo.tabla',compact('vehiculos'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
