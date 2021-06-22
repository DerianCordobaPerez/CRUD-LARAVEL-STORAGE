@extends('layouts.app')

@section('content')
    <h3 class="text-center text-muted">Practica #06 | Laravel</h3><br/>
    <h4 class="text-black-50 text-center">Cantidad de estudiantes {{count($students)}} | Cantidad de docentes {{count($teachers)}}</h4><hr/>
@endsection
