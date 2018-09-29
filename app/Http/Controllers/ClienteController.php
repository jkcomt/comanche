<?php

namespace App\Http\Controllers;
use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::where(['estado'=>'Habilitado'])->paginate(10);

        return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
                'dni'=>'required|unique:clientes,dni|unique:personales,dni',
                'celular'=>'nullable|unique:clientes',
                'direccion'=>'nullable',
                'email'=>'email|nullable|unique:clientes,email',
                'ruc'=>'nullable'
            ],[
                'apellidos.required'=>'El campo apellido es obligatorio',
                'nombres.required'=>'El campo nombres es obligatorio',
                'dni.required'=>'El campo es obligatorio',
                'celular.unique'=>'El campo celular ya existe',
                'email.unique'=>'El campo email ya existe',
                'email.email'=>'Ingrese un email válido'
            ]);

            Cliente::create([
                'apellidos'=>$data['apellidos'],
                'nombres'=>$data['nombres'],
                'dni'=>$data['dni'],
                'celular'=>$data['celular'],
                'direccion'=>$data['direccion'],
                'email'=>$data['email'],
                'ruc'=>$data['ruc'],
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return response()->json(
            $cliente->toArray()
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
        $cliente = Cliente::find($request['id']);

        $data = request()->validate([
            'apellidos'=>'required',
            'nombres'=>'required',
            'dni'=>'required|min:8|unique:clientes,dni,'.$cliente->dni.',dni|unique:personales,dni,'.$cliente->dni.',dni',
            'celular'=>'nullable|unique:clientes,celular,'.$cliente->celular.',celular',
            'direccion'=>'nullable',
            'email'=>'nullable|email|unique:clientes,email,'.$cliente->email.',email',
            'ruc'=>'nullable'
        ],[
            'apellidos.required'=>'El campo apellido es obligatorio',
            'nombres.required'=>'El campo nombres es obligatorio',
            'dni.required'=>'El campo dni es obligatorio',
            'celular.unique'=>'El campo celular ya existe',
            'email.unique'=>'El campo email ya existe',
            'email.email'=>'Ingrese un email válido'
        ]);

        $cliente->update([
            'apellidos'=>$data['apellidos'],
            'nombres'=>$data['nombres'],
            'dni'=>$data['dni'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion'],
            'email'=>$data['email'],
            'ruc'=>$data['ruc']
        ]);

        $cliente->save();


        return response()->json([
            'mensaje'=>$cliente->toArray()
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
        $cliente = Cliente::find($request['id']);

        $cliente->update([
            'estado'=>'Inhabilitado'
        ]);

        $cliente->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $clientes = null;
        if($request['buscar'] != '')
        {
            $clientes = Cliente::where('apellidos','like','%'.$request['buscar'].'%')
                ->orWhere('dni','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $clientes = Cliente::where('estado','Habilitado')->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('clientes.tabla',compact('clientes'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
