<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;

class CourseController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Course::query()->withCount('students');
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qry) use ($q) {
                $qry->where('course_code', 'like', "%{$q}%")
                    ->orWhere('course_name', 'like', "%{$q}%");
            });
        }
        $courses = $query->orderBy('course_code')->get();
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('students');
        $enrolledIds = $course->students->pluck('id')->toArray();
        $availableStudents = Student::query()
            ->whereNotIn('id', $enrolledIds)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('courses.show', compact('course', 'availableStudents'));
    }
}
