@extends('layouts.app')

@section('content')

    @if(!is_null($res))
        <div class="alert alert-success" role="alert">{{$res}}</div>
    @endif

    @if (count($list) > 0)
        <table class="table">
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Informacion</th>
                <th scope="col">Acciones</th>
            </tr>

            @foreach($list as $student)
                <tr>
                    <td class="center">
                        <img src="{{asset('/storage/'.$student->image)}}" alt="Imagen" class="student-image">
                    </td>

                    <td>
                        <b>Carnet</b> {{$student->license}}<br/>
                        <b>Nombre:</b> {{$student->name}}<br/>
                        <b>Email:</b> {{$student->email}}<br/>
                        <b>Edad:</b> {{$student->age}}
                    </td>

                    <td>
                        <button class="btn btn-warning button-width"><a class="link" href="/student/edit/{{$student->license}}">Editar</a></button><br>
                        <button class="btn btn-danger my-2 button-width"><a class="link" href="/student/delete/{{$student->license}}">Eliminar</a></button>
                    </td>
                </tr>
            @endforeach

        </table>
    @else
        <h3 class="text-muted">
            No se han agregado estudiantes
        </h3>
    @endif
@endsection
