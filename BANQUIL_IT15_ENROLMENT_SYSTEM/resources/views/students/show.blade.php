@extends('layouts.app')

@section('title', $student->first_name . ' ' . $student->last_name)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('students.index') }}" class="inline-flex items-center gap-1 text-sm font-medium text-gray-600 hover:text-red-600 transition-colors">← Back to Students</a>
    </div>

    <div class="rounded-xl border-2 border-red-200 bg-white shadow-lg overflow-hidden mb-8">
        <div class="px-4 py-3 bg-red-600">
            <h1 class="text-lg font-semibold text-white">Student Information</h1>
        </div>
        <dl class="divide-y divide-gray-200">
            <div class="px-4 py-3 flex gap-4">
                <dt class="w-36 shrink-0 text-sm font-medium text-gray-600">Student Number</dt>
                <dd class="text-sm text-gray-900">{{ $student->student_number }}</dd>
            </div>
            <div class="px-4 py-3 flex gap-4">
                <dt class="w-36 shrink-0 text-sm font-medium text-gray-600">First Name</dt>
                <dd class="text-sm text-gray-900">{{ $student->first_name }}</dd>
            </div>
            <div class="px-4 py-3 flex gap-4">
                <dt class="w-36 shrink-0 text-sm font-medium text-gray-600">Last Name</dt>
                <dd class="text-sm text-gray-900">{{ $student->last_name }}</dd>
            </div>
            <div class="px-4 py-3 flex gap-4">
                <dt class="w-36 shrink-0 text-sm font-medium text-gray-600">Email</dt>
                <dd class="text-sm text-gray-900">{{ $student->email }}</dd>
            </div>
        </dl>
    </div>

    <div class="rounded-xl border-2 border-red-200 bg-white shadow-lg overflow-hidden">
        <div class="px-4 py-3 bg-red-600 text-white">
            <h2 class="font-semibold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                Enrolled Courses
            </h2>
        </div>
        <ul class="divide-y divide-gray-200">
            @forelse ($student->courses as $course)
            <li>
                <a href="{{ route('courses.show', $course) }}" class="grid grid-cols-[1fr_80px_auto] gap-4 items-center px-4 py-3 hover:bg-red-50/50 transition-colors">
                    <span class="font-medium text-gray-900 text-left">{{ $course->course_name }}</span>
                    <span class="text-sm text-gray-600 text-left">{{ $course->course_code }}</span>
                    <span class="inline-block px-3 py-1.5 rounded-lg text-sm font-medium bg-red-600 text-white hover:bg-red-700 transition-colors">View</span>
                </a>
            </li>
            @empty
            <li class="px-4 py-8 text-center text-gray-500 text-sm">This student is not enrolled in any courses.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
