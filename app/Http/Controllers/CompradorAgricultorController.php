<?php

namespace App\Http\Controllers;

use App\CompradorPersona;
use Illuminate\Http\Request;

class CompradorAgricultorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compradorPersonas = CompradorPersona::where(['estado'=>'Habilitado'])->paginate(10);

        return view('comprador_persona.index',compact('compradorPersonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comprador_persona.create');
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
            //$data = request();
            //dd($data['dni']);
            $data = request()->validate([
                'apellidos'=>'required',
                'nombres'=>'required',
                'dni'=>'sometimes|min:8|numeric|required_without:ruc|unique:agricultores,dni|unique:personales,dni|nullable',
                'celular'=>'nullable|unique:agricultores',
                'direccion'=>'nullable',
                'email'=>'email|nullable|unique:agricultores,email',
                'ruc'=>'sometimes|numeric|required_without:dni|unique:agricultores,ruc|nullable'
            ],[
                'apellidos.required'=>'El campo apellido es obligatorio',
                'nombres.required'=>'El campo nombres es obligatorio',
                'dni.required'=>'El campo es obligatorio',
                'dni.unique'=>'El campo ya ha sido registrado',
                'celular.unique'=>'El campo celular ya existe',
                'email.unique'=>'El campo email ya existe',
            ]);

            CompradorPersona::create([
                'apellidos'=>$data['apellidos'],
                'nombres'=>$data['nombres'],
                'dni'=>$data['dni'],
                'celular'=>$data['celular'],
                'direccion'=>$data['direccion'],
                'email'=>$data['email'],
                'ruc'=>(isset($data['ruc']))? $data['ruc']:null,
                'estado'=>'Habilitado',
            ]);
            return response()->json(['mensaje'=>$data['ruc']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompradorAgricultor  $compradorAgricultor
     * @return \Illuminate\Http\Response
     */
    public function show(CompradorPersona $compradorAgricultor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompradorAgricultor  $compradorAgricultor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compradorPersona = CompradorPersona::find($id);

        return response()->json(
            $compradorPersona->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompradorAgricultor  $compradorAgricultor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompradorPersona $compradorAgricultor)
    {
        $compradorPersona = CompradorPersona::find($request['id']);

        $data = request()->validate([
            'apellidos'=>'required',
            'nombres'=>'required',
            'dni'=>'sometimes|min:8|numeric|required_without:ruc|unique:agricultores,dni,'.$compradorPersona->dni.',dni|unique:personales,dni,'.$compradorPersona->dni.',dni|nullable',
            'celular'=>'nullable|unique:agricultores,celular,'.$compradorPersona->celular.',celular',
            'direccion'=>'nullable',
            'email'=>'nullable|email|unique:agricultores,email,'.$compradorPersona->email.',email',
            'ruc'=>'sometimes|numeric|required_without:dni|unique:agricultores,ruc,'.$compradorPersona->ruc.',ruc|nullable'
        ],[
            'apellidos.required'=>'El campo apellido es obligatorio',
            'nombres.required'=>'El campo nombres es obligatorio',
            'dni.required'=>'El campo dni es obligatorio',
            'dni.unique'=>'El dni ya ha sido registrado',
            'celular.unique'=>'El campo celular ya existe',
            'email.unique'=>'El campo email ya existe',
            'email.email'=>'Ingrese un email válido',
        ]);

        $compradorPersona->update([
            'apellidos'=>$data['apellidos'],
            'nombres'=>$data['nombres'],
            'dni'=>$data['dni'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion'],
            'ruc'=>$data['ruc'],
            'email'=>$data['email']
        ]);

        $compradorPersona->save();


        return response()->json([
            'mensaje'=>$compradorPersona->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompradorAgricultor  $compradorAgricultor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $compradorPersona = CompradorPersona::find($request['id']);

        $compradorPersona->update([
            'estado'=>'Inhabilitado'
        ]);

        $compradorPersona->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $compradorPersonas = null;
        if($request['buscar'] != '')
        {
            $compradorPersonas = CompradorPersona::where('apellidos','like','%'.$request['buscar'].'%')->orWhere('ruc','like','%'.$request['buscar'].'%')->orWhere('dni','like','%'.$request['buscar'].'%');
            $compradorPersonas = $compradorPersonas->where('estado','Habilitado')->paginate(10);
        }else{
            $compradorPersonas = CompradorPersona::where('estado','Habilitado')->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('comprador_persona.tabla',compact('compradorPersonas'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
