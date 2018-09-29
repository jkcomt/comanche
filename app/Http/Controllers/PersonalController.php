<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personales = Personal::where(['estado'=>'Habilitado'])->paginate(10);

        return view('personal.index',compact('personales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personal.create');
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
                'dni'=>'required|unique:personales,dni|min:8',
                'celular'=>'nullable|unique:personales',
                'direccion'=>'nullable',
                'email'=>'email|nullable|unique:personales,email'
            ],[
                'apellidos.required'=>'El campo apellido es obligatorio',
                'nombres.required'=>'El campo nombres es obligatorio',
                'dni.required'=>'El campo dni es obligatorio',
                'celular.unique'=>'El campo celular ya existe',
                'email.unique'=>'El campo email ya existe',
            ]);

            Personal::create([
                'apellidos'=>$data['apellidos'],
                'nombres'=>$data['nombres'],
                'dni'=>$data['dni'],
                'celular'=>$data['celular'],
                'direccion'=>$data['direccion'],
                'email'=>$data['email'],
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
        $personal = Personal::find($id);

        return response()->json(
            $personal->toArray()
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
        $personal = Personal::find($request['id']);

        $data = request()->validate([
            'apellidos'=>'required',
            'nombres'=>'required',
            'dni'=>'required|min:8|unique:personales,dni,'.$personal->dni.',dni',
            'celular'=>'nullable|unique:personales,celular,'.$personal->celular.',celular',
            'direccion'=>'nullable',
            'email'=>'email|nullable|unique:personales,email,'.$personal->email.',email'
        ],[
            'apellidos.required'=>'El campo apellido es obligatorio',
            'nombres.required'=>'El campo nombres es obligatorio',
            'dni.required'=>'El campo dni es obligatorio',
            'celular.unique'=>'El campo celular ya existe',
            'email.unique'=>'El campo email ya existe',
            'email.email'=>'Ingrese un email válido'
        ]);

        $personal->update([
            'apellidos'=>$data['apellidos'],
            'nombres'=>$data['nombres'],
            'dni'=>$data['dni'],
            'celular'=>$data['celular'],
            'direccion'=>$data['direccion'],
            'email'=>$data['email']
        ]);

        $personal->save();


        return response()->json([
            'mensaje'=>$personal->toArray()
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
        $personal = Personal::find($request['id']);

        $personal->update([
            'estado'=>'Inhabilitado'
        ]);

        $personal->save();

        return response()->json([
            'mensaje'=>"eliminacion exitosa"
        ]);
    }

    public function search(Request $request){

        $personales = null;
        if($request['buscar'] != '')
        {
            $personales = Personal::where('apellidos','like','%'.$request['buscar'].'%')
                ->orWhere('dni','like','%'.$request['buscar'].'%')->paginate(10);
        }else{
            $personales = Personal::where('estado','Habilitado')->paginate(10);
        }

        if($request->ajax())
        {
            $view = view('personal.tabla',compact('personales'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
