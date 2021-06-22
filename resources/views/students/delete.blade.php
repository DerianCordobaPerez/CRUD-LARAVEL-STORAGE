@extends('layouts.app')

@section('content')
    <form action="{{url('/student/delete')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="studentLicense" value="{{$student->license}}" />
        <div class="container bg-light my-4 p-4">
            <div class="alert alert-success" role="alert">
                <h3 class="text-center">Estas seguro que desea eliminar a {{$student->name}}</h3>
            </div>

            <div class="row my-4">
                <div class="col-md-8">
                    <h3>Informacion</h3><br/>
                    <b>Carnet: </b> {{$student->license}}<br/>
                    <b>Nombre: </b> {{$student->name}}<br/>
                    <b>Email: </b> {{$student->email}}<br/>
                    <b>Edad: </b> {{$student->age}}<br/>
                    <b>Curso: </b> {{$student->course}}<br/>
                </div>

                <div class="col-md-4">
                    <h3>Imagen</h3><br/>
                    <img src="{{asset('/storage/'.$student->image)}}" alt="Imagen" class="student-image">
                </div>
            </div>

            <div class="row my-4">
                <div class="col-md-6">
                    <button class="btn btn-warning button-width"><a class="link" href="/">No, volver al inicio</a></button><br>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-danger button-width" name="buttonDelete" type="submit">Si</button>
                </div>
            </div>
        </div>
    </form>
@endsection

