<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use App\User;
use App\Personal;
use App\Area;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::where(['estado'=>'Habilitado'])->paginate(10);

        return view('usuario.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personales = Personal::leftjoin('users','personales.id','=','users.personal_id')
            ->select(DB::raw("CONCAT(nombres,' ',apellidos) as nombres_completos"),'personales.id')
            ->where('personales.estado','=','Habilitado')
            ->whereNull('users.personal_id')
            ->get()->pluck('nombres_completos','id')->toArray();

        $areas = Area::where('estado','=','Habilitado')->pluck('descripcion','id')->toArray();
        return view('usuario.create',compact('personales','areas'));
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
                'name'=>['required',Rule::unique('users')],
//                'email'=>['required','unique:users,email'],
                'password'=>'required',
                'area'=>'required',
                'personal'=>'required',
            ],[
                'name.unique'=>'El nick ya ha sido registrado',
                'name.required'=>'El campo nick es obligatorio',
//                'email.required'=>'El campo email es obligatorio',
                'password.required'=>'El campo password es obligatorio',
                'area.required'=>'El campo area es obligatorio',
                'personal.required'=>'El campo personal es obligatorio',
            ]);

            User::create([
                'name'=>$data['name'],
//                'email'=>$data['email'],
                'password'=>$data['password'],
                'area_id'=>$data['area'],
                'personal_id'=>$data['personal'],
                'estado'=>'Habilitado',
                'remember_token'=>str_random(10)
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
//        $personales = Personal::leftjoin('users','personales.id','=','users.personal_id')
//            ->select(DB::raw("CONCAT(nombres,' ',apellidos) as nombres_completos"),'personales.id')
//            ->where('personales.estado','=','Habilitado')
//            ->whereNull('users.personal_id')
//            ->get()->pluck('nombres_completos','id')->toArray();

        $areas = Area::where('estado','=','Habilitado')->pluck('descripcion','id')->toArray();

        $usuario = User::with('personal')->find($id);

        return response()->json(
            array('usuario'=>$usuario,'areas'=>$areas)
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
        $usuario = User::find($request['id']);

        $data = request()->validate([
//            'email'=>['required',Rule::unique('users')->ignore($request['id'])],
            'name'=>['required',Rule::unique('users')->ignore($request['id'])],
            'password'=>'nullable',
            'area'=>'required'
        ],[
            'name.unique'=>'El nick ya ha sido registrado',
//            'email.required'=>'El campo email es obligatorio',
            'area.required'=>'El campo area es obligatorio'
        ]);

        if($data['password']!=null)
        {
            $usuario->setPasswordAttribute($data['password']);
        }

        $usuario->update([
//            'email'=>$data['email'],
            'area_id'=>$data['area']
        ]);

        $usuario->save();


        return response()->json([
            'mensaje'=>$data
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
        $usuario = User::find($request['id']);

        $usuario->update([
            'estado'=>'Inhabilitado'
        ]);

        $usuario->save();

        return response()->json([
            'mensaje'=>"eliminación exitosa"
        ]);
    }

    public function search(Request $request){

        $usuarios = null;
        if($request['buscar'] != '')
        {
            $usuarios = User::leftjoin('personales','personales.id','=','users.personal_id')
            ->where('personales.apellidos','like','%'.$request['buscar'].'%')->where('users.estado','Habilitado')->paginate(10);
        }else{
            $usuarios = User::where(['estado'=>'Habilitado'])->paginate(10);
        }


        if($request->ajax())
        {
            $view = view('usuario.tabla',compact('usuarios'))->render();
            return response()->json(['html'=>$view]);
        }
    }
}
