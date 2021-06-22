<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable {
        return view('home')
            ->with('students', $this->getFileContent('studentList.txt'))
            ->with('teachers', $this->getFileContent('teacherList.txt'));
    }

    private function getFileContent(String $filename, String $location = 'local'): array {
        return Storage::disk($location)->exists($filename) ? unserialize(Storage::get($filename)) : array();
    }
}
