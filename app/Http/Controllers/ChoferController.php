<?php

namespace App\Http\Controllers;
use App\Chofer;
use Illuminate\Http\Request;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choferes = Chofer::where(['estado'=>'Habilitado'])->paginate(10);

        return view('chofer.index',compact('choferes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chofer.create');
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
                'apellidos' => 'required',
                'nombres' => 'required',
                'dni'=>'required|unique:choferes,dni|min:8|unique:personales,dni',
                'celular'=>'nullable|unique:choferes',
                'direccion' => 'nullable'
            ], [
                'apellidos.required'=>'El campo apellido es obligatorio',
                'nombres.required'=>'El campo nombres es obligatorio',
                'dni.required'=>'El campo dni es obligatorio',
                'celular.unique'=>'El campo celular ya existe',
            ]);

            Chofer::create([
                'apellidos' => $data['apellidos'],
                'nombres' => $data['nombres'],
                'dni' => $data['dni'],
                'celular' => $data['celular'],
                'direccion' => $data['direccion'],
                'estado' => 'Habilitado'
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
        $chofer = Chofer::find($id);

        return response()->json(
            $chofer->toArray()
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
        $chofer = Chofer::find($request['id']);

        $data = request()->validate([
            'apellidos'=>'required',
            'nombres'=>'required',
            'dni'=>'required|min:8|unique:choferes,dni,'.$chofer->dni.',dni|unique:personales,dni,'.$chofer->dni.',dni',
            'celular'=>'nullable|unique:choferes,celular,'.$chofer->celular.',celular',
            'direccion'=>'nullable'
        ],[
            'apellidos.required'=>'El campo apellido es obligatorio',
            'nombres.required'=>'El campo nombres es obligatorio',
            'dni.required'=>'El campo dni es obligatorio',
            'celular.unique'=>'El campo celular ya existe',
        ]);

        $chofer->update([
            'apellidos'=>$data['apellidos'],
            'nombres'=>$data['nombres'],
            'dni'=>$data['dni'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion']
        ]);

        $chofer->save();


        return response()->json([
            'mensaje'=>$chofer->toArray()
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
        $chofer = Chofer::find($request['id']);

        $chofer->update([
            'estado'=>'Inhabilitado'
        ]);

        $chofer->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $choferes = null;

        if($request['buscar'] != '')
        {
            $choferes = Chofer::where('apellidos','like','%'.$request['buscar'].'%')
                ->orWhere('dni','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $choferes = Chofer::where('estado','Habilitado')->paginate(10);
        }

        if($request->ajax())
        {
            $view = view('chofer.tabla',compact('choferes'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
