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

            @foreach($list as $teacher)
                <tr>
                    <td class="center">
                        <img src="{{asset('/storage/'.$teacher->image)}}" alt="Imagen" class="student-image">
                    </td>

                    <td>
                        <b>Nombre: </b> {{$teacher->name}}<br/>
                        <b>Email:</b> {{$teacher->email}}<br/>
                        <b>Inss:</b> {{$teacher->inss}}<br/>
                    </td>

                    <td>
                        <button class="btn btn-warning button-width"><a class="link" href="/teacher/edit/{{$teacher->inss}}">Editar</a></button><br>
                        <button class="btn btn-danger my-2 button-width"><a class="link" href="/teacher/delete/{{$teacher->inss}}">Eliminar</a></button>
                    </td>
                </tr>
            @endforeach

        </table>
    @else
        <h3 class="text-muted">
            No se han agregado docentes
        </h3>
    @endif
@endsection
