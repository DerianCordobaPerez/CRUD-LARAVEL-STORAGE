<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class StudentController extends Controller {

    public function __construct() {}

    public function renderAdd(): Renderable {
        return view('students.addOrEdit')->with('res')->with('student');
    }

    public function renderDelete($license): Renderable {
        $students = $this->getFileContent('studentList.txt');
        $studentDelete = null;
        foreach ($students as $student) {
            if($student->license === $license) {
                $studentDelete = $student;
                break;
            }
        }
        return view('students.delete')->with('student', $studentDelete);
    }

    public function renderList(): Renderable {
        return view('students.list')->with('res')->with('list', $this->getFileContent('studentList.txt'));
    }

    public function add(Request $request): Renderable {
        $result = 'No se guardo correctamente el estudiante';

        if($request->isMethod('POST') && $request->has('buttonSend')) {
            $students = $this->getFileContent('studentList.txt');

            $image = ($request->file('studentImage'))->getClientOriginalName();
            Storage::disk('public')->put($image, File::get($request->file('studentImage')));

            array_push($students, $this->setStudentForRequest($request, $image));
            Storage::disk('local')->put('studentList.txt', serialize($students));

            $result = 'Estudiante guardado correctamente';
        }
        return view('students.addOrEdit')->with('res', $result)->with('student');
    }

    public function renderEdit($license): Renderable {
        $students = $this->getFileContent('studentList.txt');
        $studentEdit = null;
        foreach ($students as $student) {
            if($student->license === $license) {
                $studentEdit = $student;
                break;
            }
        }
        return view('students.addOrEdit')->with('res')->with('student', $studentEdit);
    }

    public function edit(Request $request): Renderable {
        $result = 'No se edito correctamente el estudiante';
        $students = $this->getFileContent('studentList.txt');
        if($request->isMethod('POST') && $request->has('buttonSend')) {
            $image = ($request->file('studentImage'))->getClientOriginalName();
            Storage::disk('public')->put($image, File::get($request->file('studentImage')));

            for ($i = 0; $i < count($students); ++$i) {
                if($students[$i]->license === $request->input('studentLicense')) {
                    Storage::disk('public')->delete($request->input('originalStudentImage'));
                    $students[$i] = $this->setStudentForRequest($request, $image);
                    break;
                }
            }
            Storage::disk('local')->put('studentList.txt', serialize($students));
            $result = 'Estudiante guardado correctamente';
        }
        return view('students.list')->with('res', $result)->with('list', $students);
    }

    public function delete(Request $request): Renderable {
        $result = 'No se elimino correctamente el estudiante';
        $students = $this->getFileContent('studentList.txt');
        if($request->isMethod('POST') && $request->has('buttonDelete')) {
            for ($i = 0; $i < count($students); ++$i) {
                if(!is_null($students[$i])) {
                    if($students[$i]->license === $request->input('studentLicense')) {
                        Storage::disk('public')->delete($students[$i]->image);
                        unset($students[$i]);
                        break;
                    }
                }
            }
            Storage::disk('local')->put('studentList.txt', serialize($students));
            $result = 'Estudiante eliminado correctamente';
        }
        return view('students.list')->with('res', $result)->with('list', $students);
    }

    private function getFileContent(String $filename, String $location = 'local'): array {
        return Storage::disk($location)->exists($filename) ? unserialize(Storage::get($filename)) : array();
    }

    private function setStudentForRequest(Request $request, $image): stdClass {
        $student = new stdClass();
        $student->email = $request->input('studentEmail');
        $student->name = $request->input('studentName');
        $student->license = $request->input('studentLicense');
        $student->age = $request->input('studentAge');
        $student->course = $request->input('studentCourse');
        $student->image = $image;
        return $student;
    }
}
