@extends('layouts.app')

@section('content')
    @if(!is_null($res))
        <div class="alert alert-success" role="alert">{{$res}}</div>
    @endif

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5">
                <h3 class="text-center text-muted">Formulario de Docente</h3>

                <form action="{{url(is_null($teacher) ? '/teacher/add' : '/teacher/edit')}}" method="POST" class="col-md-6" enctype="multipart/form-data">
                    {{csrf_field()}}

                    @if(!is_null($teacher))
                        <input type="hidden" name="originalTeacherImage" value="{{$teacher->image}}">
                    @endif

                    <div class="form-input">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control col-md-6" name="teacherName" placeholder="Name" value="{{$teacher->name ?? ''}}" required />
                    </div>

                    <div class="form-input">
                        <i class="fa fa-envelope"></i>
                        <input type="name" class="form-control col-md-6" name="teacherEmail" placeholder="Email" value="{{$teacher->email ?? ''}}" maxlength="50" required />
                    </div>

                    <div class="form-input">
                        <i class="far fa-id-card"></i>
                        <input type="text" class="form-control col-md-6" name="teacherInss" placeholder="Inss" value="{{$teacher->inss ?? ''}}" {{!is_null($teacher) ? ' readonly ' : ''}} maxlength="10" required />
                    </div>

                    <div class="form-input">
                        <input type="file" class="form-control" name="teacherImage" id="teacherImage" required />
                    </div>

                    <button type="submit" name="buttonSend" value="Send" class="btn btn-primary mt-4 signup">Send Information</button>
                </form>

            </div>
        </div>
    </div>
@endsection
