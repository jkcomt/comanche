<?php

namespace App\Http\Controllers;

use App\CompradorEmpresa;
use Illuminate\Http\Request;

class CompradorEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compradorEmpresas = CompradorEmpresa::where(['estado'=>'Habilitado'])->paginate(10);

        return view('comprador_empresa.index',compact('compradorEmpresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comprador_empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (request()->ajax()) {
            //$data = request();
            //dd($data['rbTipoAgri']);
            $data = request()->validate([
                'razon_social' => 'required',
                'ruc' => 'required|unique:empresas,ruc|max:11|min:11',
                'telefono' => 'nullable|unique:empresas',
                'direccion' => 'nullable',
                'email' => 'email|nullable|unique:empresas,email',
                'representante'=>'required',
                'dni_representante'=>'required|numeric|unique:empresas,dni_representante|min:8'
            ], [
                'razon_social.required' => 'El campo razón social es obligatorio',
                'ruc.required' => 'El campo es obligatorio',
                'ruc.unique' => 'El campo ya ha sido registrado',
                'telefono.unique' => 'El campo telefono ya existe',
                'email.unique' => 'El campo email ya existe',
            ]);

            CompradorEmpresa::create([
                'razon_social' => $data['razon_social'],
                'ruc' => $data['ruc'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'email' => $data['email'],
                'representante'=>$data['representante'],
                'dni_representante'=>$data['dni_representante'],
                'estado' => 'Habilitado',
            ]);
            return response()->json(['mensaje' => "registro exitoso"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompradorEmpresa  $compradorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function show(CompradorEmpresa $compradorEmpresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompradorEmpresa  $compradorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compradorEmpresa = CompradorEmpresa::find($id);

        return response()->json(
            $compradorEmpresa->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompradorEmpresa  $compradorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $compradorEmpresa = CompradorEmpresa::find($request['id']);

        $data = request()->validate([
            'razon_social'=>'required',
            'ruc'=>'required|unique:empresas,ruc,'.$compradorEmpresa->ruc.',ruc',
            'telefono'=>'nullable|unique:empresas,telefono,'.$compradorEmpresa->telefono.',telefono',
            'direccion'=>'nullable',
            'email'=>'nullable|email|unique:empresas,email,'.$compradorEmpresa->email.',email',
            'representante'=>'required',
            'dni_representante'=>'required|numeric|unique:empresas,dni_representante,'.$compradorEmpresa->dni_representante.',dni_representante'
        ],[
            'razon_social.required'=>'El campo es obligatorio',
            'ruc.required'=>'El campo ruc es obligatorio',
            'ruc.unique'=>'El ruc ya ha sido registrado',
            'telefono.unique'=>'El campo telefono ya existe',
            'email.unique'=>'El campo email ya existe',
            'email.email'=>'Ingrese un email válido',
        ]);

        $compradorEmpresa->update([
            'razon_social'=>$data['razon_social'],
            'ruc'=>$data['ruc'],
            'telefono'=>$data['telefono'],
            'direccion'=>$data['direccion'],
            'email'=>$data['email'],
            'representante'=>$data['representante'],
            'dni_representante'=>$data['dni_representante']
        ]);

        $compradorEmpresa->save();


        return response()->json([
            'mensaje'=>$compradorEmpresa->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompradorEmpresa  $compradorEmpresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $compradorEmpresa = CompradorEmpresa::find($request['id']);

        $compradorEmpresa->update([
            'estado'=>'Inhabilitado'
        ]);

        $compradorEmpresa->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $compradorEmpresas = null;
        if($request['buscar'] != '')
        {
            $compradorEmpresas = CompradorEmpresa::where('razon_social','like','%'.$request['buscar'].'%')->orWhere('ruc','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $compradorEmpresas = CompradorEmpresa::where('estado','Habilitado')->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('comprador_empresa.tabla',compact('compradorEmpresas'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
