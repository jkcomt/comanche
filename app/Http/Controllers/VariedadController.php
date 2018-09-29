<?php

namespace App\Http\Controllers;
use App\Variedad;
use Illuminate\Http\Request;

class VariedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variedades = Variedad::where(['estado'=>'Habilitado'])->paginate(10);

        return view('variedad.index',compact('variedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('variedad.create');
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
                'descripcion' => 'required'
            ], [
                'descripcion.required' => 'El campo descripcion es obligatorio'
            ]);

            Variedad::create([
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
        $variedad = Variedad::find($id);

        return response()->json(
            $variedad->toArray()
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
        $variedad = Variedad::find($request['id']);

        $data = request()->validate([
            'descripcion'=>'required'
        ],[
            'descripcion.required'=>'El campo descripcion es obligatorio'
        ]);

        $variedad->update([
            'descripcion'=>$data['descripcion']
        ]);

        $variedad->save();


        return response()->json([
            'mensaje'=>$variedad->toArray()
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
        $variedad = Variedad::find($request['id']);

        $variedad->update([
            'estado'=>'Inhabilitado'
        ]);

        $variedad->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $variedades = null;
        if($request['buscar'] != '')
        {
            $variedades = Variedad::where('descripcion','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $variedades = Variedad::where('estado','Habilitado')->paginate(10);
        }

        if($request->ajax())
        {
            $view = view('variedad.tabla',compact('variedades'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
