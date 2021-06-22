
@extends('layouts.app')

@section('content')
    <form action="{{url('/teacher/delete')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="teacherInss" value="{{$teacher->inss}}" />
        <div class="container bg-light my-4 p-4">
            <div class="alert alert-success" role="alert">
                <h3 class="text-center">Estas seguro que desea eliminar a {{$teacher->name}}</h3>
            </div>

            <div class="row my-4">
                <div class="col-md-8">
                    <h3>Informacion</h3><br/>
                    <b>Nombre: </b> {{$teacher->name}}<br/>
                    <b>Email: </b> {{$teacher->email}}<br/>
                    <b>Inss: </b> {{$teacher->inss}}<br/>
                </div>

                <div class="col-md-4">
                    <h3>Imagen</h3><br/>
                    <img src="{{asset('/storage/'.$teacher->image)}}" alt="Imagen" class="student-image">
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

