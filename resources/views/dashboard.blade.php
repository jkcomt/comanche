@extends('layout')

@section('content')
    <div class="panel panel-heading">
        <h1 class="panel-title"><strong>Bienvenid@ {{auth()->user()->personal->nombres}}</strong></h1>

    </div>
    <div class="panel panel-body">
        <h1 class="text-center">SISTEMA COMANCHE</h1>
    </div>

@endsection