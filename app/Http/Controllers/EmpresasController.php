<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::where(['estado'=>'Habilitado'])->paginate(10);

        return view('empresa.index',compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.create');
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

            Empresa::create([
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
     * @param  \App\Empresa  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::find($id);

        return response()->json(
            $empresa->toArray()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $empresa = Empresa::find($request['id']);

        $data = request()->validate([
            'razon_social'=>'required',
            'ruc'=>'required|unique:empresas,ruc,'.$empresa->ruc.',ruc',
            'telefono'=>'nullable|unique:empresas,telefono,'.$empresa->telefono.',telefono',
            'direccion'=>'nullable',
            'email'=>'nullable|email|unique:empresas,email,'.$empresa->email.',email',
            'representante'=>'required',
            'dni_representante'=>'required|numeric|unique:empresas,dni_representante,'.$empresa->dni_representante.',dni_representante'
        ],[
            'razon_social.required'=>'El campo es obligatorio',
            'ruc.required'=>'El campo ruc es obligatorio',
            'ruc.unique'=>'El ruc ya ha sido registrado',
            'telefono.unique'=>'El campo telefono ya existe',
            'email.unique'=>'El campo email ya existe',
            'email.email'=>'Ingrese un email válido',
        ]);

        $empresa->update([
            'razon_social'=>$data['razon_social'],
            'ruc'=>$data['ruc'],
            'telefono'=>$data['telefono'],
            'direccion'=>$data['direccion'],
            'email'=>$data['email'],
            'representante'=>$data['representante'],
            'dni_representante'=>$data['dni_representante']
        ]);

        $empresa->save();


        return response()->json([
            'mensaje'=>$empresa->toArray()
        ]);
    }

    public function destroy(Request $request)
    {
        $empresa = Empresa::find($request['id']);

        $empresa->update([
            'estado'=>'Inhabilitado'
        ]);

        $empresa->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $empresas = null;
        if($request['buscar'] != '')
        {
            $empresas = Empresa::where('razon_social','like','%'.$request['buscar'].'%')->orWhere('ruc','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $empresas = Empresa::where('estado','Habilitado')->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('empresa.tabla',compact('empresas'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
