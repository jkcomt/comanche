<?php

namespace App\Http\Controllers;

use App\Agricultor;
use Illuminate\Http\Request;

class AgricultorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agricultores = Agricultor::where(['estado'=>'Habilitado'])->paginate(10);

        return view('agricultor.index',compact('agricultores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agricultor.create');
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

            Agricultor::create([
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
        $agricultor = Agricultor::find($id);

        return response()->json(
          $agricultor->toArray()
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

        $agricultor = Agricultor::find($request['id']);

        $data = request()->validate([
            'apellidos'=>'required',
            'nombres'=>'required',
            'dni'=>'sometimes|min:8|numeric|required_without:ruc|unique:agricultores,dni,'.$agricultor->dni.',dni|unique:personales,dni,'.$agricultor->dni.',dni|nullable',
            'celular'=>'nullable|unique:agricultores,celular,'.$agricultor->celular.',celular',
            'direccion'=>'nullable',
            'email'=>'nullable|email|unique:agricultores,email,'.$agricultor->email.',email',
            'ruc'=>'sometimes|numeric|required_without:dni|unique:agricultores,ruc,'.$agricultor->ruc.',ruc|nullable'
        ],[
            'apellidos.required'=>'El campo apellido es obligatorio',
            'nombres.required'=>'El campo nombres es obligatorio',
            'dni.required'=>'El campo dni es obligatorio',
            'dni.unique'=>'El dni ya ha sido registrado',
            'celular.unique'=>'El campo celular ya existe',
            'email.unique'=>'El campo email ya existe',
            'email.email'=>'Ingrese un email válido',
        ]);

        $agricultor->update([
            'apellidos'=>$data['apellidos'],
            'nombres'=>$data['nombres'],
            'dni'=>$data['dni'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion'],
            'ruc'=>$data['ruc'],
            'email'=>$data['email']
        ]);

        $agricultor->save();


        return response()->json([
            'mensaje'=>$agricultor->toArray()
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
        $agricultor = Agricultor::find($request['id']);

        $agricultor->update([
            'estado'=>'Inhabilitado'
        ]);

        $agricultor->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);

    }

    public function search(Request $request){

        $agricultores = null;
        if($request['buscar'] != '')
        {
            $agricultores = Agricultor::where('apellidos','like','%'.$request['buscar'].'%')->orWhere('ruc','like','%'.$request['buscar'].'%')->orWhere('dni','like','%'.$request['buscar'].'%');
            $agricultores = $agricultores->where('estado','Habilitado')->paginate(10);
        }else{
            $agricultores = Agricultor::where('estado','Habilitado')->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('agricultor.tabla',compact('agricultores'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
