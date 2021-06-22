<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class TeacherController extends Controller {

    public function __construct(){}

    public function renderAdd(): Renderable {
        return view('teachers.addOrEdit')->with('res')->with('teacher');
    }

    public function renderDelete($inss): Renderable {
        $teachers = $this->getFileContent('teacherList.txt');
        $teacherDelete = null;

        foreach($teachers as $teacher) {
            if($teacher->inss === $inss) {
                $teacherDelete = $teacher;
                break;
            }
        }
        return view('teachers.delete')->with('res')->with('teacher', $teacherDelete);
    }

    public function renderList(): Renderable {
        return view('teachers.list')->with('res')->with('list', $this->getFileContent('teacherList.txt'));
    }

    public function add(Request $request): Renderable {
        $result = 'No se guardo correctamente el docente';

        if($request->isMethod('POST') && $request->has('buttonSend')) {
            $teachers = $this->getFileContent('teacherList.txt');

            $image = ($request->file('teacherImage'))->getClientOriginalName();
            Storage::disk('public')->put($image, File::get($request->file('teacherImage')));

            array_push($teachers, $this->setTeacherForRequest($request, $image));
            Storage::disk('local')->put('teacherList.txt', serialize($teachers));

            $result = 'Docente guardado correctamente';
        }
        return view('teachers.addOrEdit')->with('res', $result)->with('teacher');
    }
    public function renderEdit($inss): Renderable {
        $teachers = $this->getFileContent('teacherList.txt');
        $teacherEdit = null;

        foreach($teachers as $teacher) {
            if($teacher->inss === $inss) {
                $teacherEdit = $teacher;
                break;
            }
        }
        return view('teachers.addOrEdit')->with('res')->with('teacher', $teacherEdit);
    }

    public function edit(Request $request): Renderable {
        $result = 'No se edito correctamente el docente';
        $teachers = $this->getFileContent('teacherList.txt');
        if($request->isMethod('POST') && $request->has('buttonSend')) {
            $image = ($request->file('teacherImage'))->getClientOriginalName();
            Storage::disk('public')->put($image, File::get($request->file('teacherImage')));

            for ($i = 0; count($teachers); ++$i) {
                if($teachers[$i]->inss === $request->input('teacherInss')) {
                    Storage::disk('public')->delete($request->input('originalTeacherImage'));
                    $teachers[$i] = $this->setTeacherForRequest($request, $image);
                    break;
                }
            }
            Storage::disk('local')->put('teacherList.txt', serialize($teachers));
            $result = 'Estudiante guardado correctamente';
        }
        return view('teachers.list')->with('res', $result)->with('list', $teachers);
    }

    public function delete(Request $request): Renderable {
        $result = 'No se elimino correctamente el docente';
        $teachers = $this->getFileContent('teacherList.txt');
        if($request->isMethod('POST') && $request->has('buttonDelete')) {
            for ($i = 0; $i < count($teachers); ++$i) {
                if($teachers[$i]->inss === $request->input('teacherInss')) {
                    Storage::disk('public')->delete($teachers[$i]->image);
                    unset($teachers[$i]);
                    break;
                }
            }
            Storage::disk('local')->put('teacherList.txt', serialize($teachers));
            $result = 'Docente eliminado correctamente';
        }
        return view('teachers.list')->with('res', $result)->with('list', $teachers);
    }

    private function getFileContent(String $filename, String $location = 'local'): array {
        return Storage::disk($location)->exists($filename) ? unserialize(Storage::get($filename)) : array();
    }

    private function setTeacherForRequest(Request $request, $image): stdClass {
        $teacher = new stdClass();
        $teacher->name = $request->input('teacherName');
        $teacher->email = $request->input('teacherEmail');
        $teacher->inss = $request->input('teacherInss');
        $teacher->image = $image;
        return $teacher;
    }
}
