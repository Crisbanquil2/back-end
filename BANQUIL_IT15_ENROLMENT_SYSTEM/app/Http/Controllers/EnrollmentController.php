<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $course = Course::findOrFail($validated['course_id']);

        if ($student->courses()->where('course_id', $course->id)->exists()) {
            throw ValidationException::withMessages([
                'course_id' => ['This student is already enrolled in this course.'],
            ]);
        }

        $enrolledCount = $course->students()->count();
        if ($enrolledCount >= $course->capacity) {
            throw ValidationException::withMessages([
                'course_id' => ["This course has reached its capacity of {$course->capacity} students."],
            ]);
        }

        $student->courses()->attach($course->id);

        return back()->with('success', "Successfully enrolled {$student->first_name} {$student->last_name} in {$course->course_name}.");
    }

    public function destroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'course_id' => ['required', 'exists:courses,id'],
        ]);

        $student = Student::findOrFail($validated['student_id']);
        $course = Course::findOrFail($validated['course_id']);

        $student->courses()->detach($course->id);

        return back()->with('success', 'Student has been removed from the course.');
    }
}
