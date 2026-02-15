@extends('layouts.app')

@section('title', $course->course_name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-gray-600 hover:text-red-600 transition-colors">← Back to Courses</a>
    </div>

    <div class="rounded-xl border-2 border-red-200 bg-white shadow-lg overflow-hidden mb-8">
        <div class="px-4 py-3 bg-red-600">
            <h1 class="text-lg font-semibold text-white">Course Information</h1>
        </div>
        <table class="w-full border-collapse">
            <tbody>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-3 text-left text-sm font-semibold text-gray-600 align-top w-36">Course Code</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-900 align-top">{{ $course->course_code }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-3 text-left text-sm font-semibold text-gray-600 align-top w-36">Course Name</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-900 align-top">{{ $course->course_name }}</td>
                </tr>
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-3 text-left text-sm font-semibold text-gray-600 align-top w-36">Capacity</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-900 align-top">{{ $course->capacity }}</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 text-left text-sm font-semibold text-gray-600 align-top w-36">Enrolled</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-900 align-top">{{ $course->students->count() }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($course->students->count() < $course->capacity && $availableStudents->isNotEmpty())
    <div class="mb-8 rounded-xl border-2 border-red-200 bg-red-50/50 shadow-md p-5">
        <h2 class="font-semibold text-red-800 mb-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
            Enroll a Student
        </h2>
        <form action="{{ route('enrollments.store') }}" method="POST" class="flex flex-wrap items-end gap-3">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="min-w-[220px]">
                <label for="student_id" class="block text-sm font-medium text-red-800 mb-1">Student</label>
                <select name="student_id" id="student_id" required class="w-full rounded-lg border-2 border-red-200 bg-white px-3 py-2.5 text-gray-900 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">Select a student...</option>
                    @foreach ($availableStudents as $s)
                        <option value="{{ $s->id }}">{{ $s->last_name }}, {{ $s->first_name }} ({{ $s->student_number }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="rounded-lg px-5 py-2.5 bg-red-600 text-white font-medium hover:bg-red-700 transition-colors shadow-sm">
                Enroll
            </button>
        </form>
    </div>
    @endif

    <div class="rounded-xl border-2 border-red-200 bg-white shadow-lg overflow-hidden">
        <div class="px-4 py-3 bg-red-600 text-white">
            <h2 class="font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Enrolled Students
            </h2>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-red-50 border-b-2 border-red-200">
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">Student No.</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top w-28"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($course->students as $student)
                <tr class="border-b border-gray-200 hover:bg-red-50/50">
                    <td class="px-4 py-3 text-left text-sm font-medium text-gray-900 align-top">{{ $student->student_number }}</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-700 align-top">{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-600 align-top">{{ $student->email }}</td>
                    <td class="px-4 py-3 text-left text-sm align-top whitespace-nowrap">
                        <a href="{{ route('students.show', $student) }}" class="inline-block px-3 py-1.5 rounded-lg font-medium bg-red-600 text-white hover:bg-red-700 transition-colors mr-2">View</a>
                        <form action="{{ route('enrollments.destroy') }}" method="POST" class="inline" onsubmit="return confirm('Remove this student from the course?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium">Remove</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No students enrolled in this course yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
