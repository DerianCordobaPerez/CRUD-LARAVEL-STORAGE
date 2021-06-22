@extends('layouts.app')

@section('content')

    @if(!is_null($res))
        <div class="alert alert-success" role="alert">{{$res}}</div>
    @endif

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5">
                <h3 class="text-center text-muted">Formulario de Estudiante</h3>

                <form action="{{url(is_null($student) ? '/student/add' : '/student/edit')}}" method="POST" class="col-md-6" enctype="multipart/form-data">
                    {{csrf_field()}}

                    @if(!is_null($student))
                        <input type="hidden" name="originalStudentImage" value="{{$student->image}}">
                    @endif

                    <div class="form-input">
                        <i class="fa fa-envelope"></i>
                        <input type="email" class="form-control col-md-6" name="studentEmail" placeholder="Email" value="{{$student->email ?? ''}}" required />
                    </div>

                    <div class="form-input">
                        <i class="fa fa-user"></i>
                        <input type="text" class="form-control col-md-6" name="studentName" placeholder="Name" value="{{$student->name ?? ''}}" maxlength="50" required />
                    </div>

                    <div class="form-input">
                        <i class="far fa-id-card"></i>
                        <input type="text" class="form-control col-md-6" name="studentLicense" placeholder="License" value="{{$student->license ?? ''}}" {{!is_null($student) ? ' readonly ' : ''}} maxlength="10" required />
                    </div>

                    <div class="form-input">
                        <i>18</i>
                        <input type="number" class="form-control col-md-6" name="studentAge" placeholder="Age" value="{{$student->age ?? ''}}" min="18" max="50" required />
                    </div>

                    <div class="form-input">
                        <i class="fas fa-graduation-cap"></i>
                        <input type="number" class="form-control col-md-6" name="studentCourse" placeholder="Course" value="{{$student->course ?? ''}}" min="1" max="5" required />
                    </div>

                    <div class="form-input">
                        <input type="file" class="form-control" name="studentImage" id="studentImage" required />
                    </div>

                    <button type="submit" name="buttonSend" value="Send" class="btn btn-primary mt-4 signup">Send Information</button>
                </form>

            </div>
        </div>
    </div>
@endsection
