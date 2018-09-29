<?php

namespace App\Http\Controllers;

use App\ResultadoProducion;
use Illuminate\Http\Request;

class ResultadoProducionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResultadoProducion  $resultadoProducion
     * @return \Illuminate\Http\Response
     */
    public function show(ResultadoProducion $resultadoProducion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResultadoProducion  $resultadoProducion
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultadoProducion $resultadoProducion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResultadoProducion  $resultadoProducion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultadoProducion $resultadoProducion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultadoProducion  $resultadoProducion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultadoProducion $resultadoProducion)
    {
        //
    }

    public function listarResultados($id){
        $resultado = ResultadoProducion::Where('estado','Habilitado')->where('nueva_produccion_id',$id)->get();
        return response()->json($resultado);
    }
}
