<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('first_name', 'like', "%{$q}%")
                    ->orWhere('last_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('student_number', 'like', "%{$q}%");
            });
        }
        $students = $query->orderBy('last_name')->orderBy('first_name')->get();
        return view('students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $student->load('courses');

        return view('students.show', compact('student'));
    }
}
