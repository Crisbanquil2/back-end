@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Students</h1>
    <p class="text-gray-600 text-sm mb-6">Search and view registered students.</p>

    <div class="mb-6 w-full rounded-xl border-2 border-gray-300 bg-white h-14 flex items-center pl-4 pr-2 gap-2">
        <span class="flex items-center justify-center w-9 h-9 shrink-0 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </span>
        <form method="GET" action="{{ route('students.index') }}" class="flex-1 flex min-w-0 h-full items-center">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Search by name, email, or student number..." class="flex-1 min-w-0 h-full px-2 py-0 bg-transparent text-gray-900 placeholder-gray-500 border-0 focus:ring-0 text-base">
        </form>
    </div>

    <div class="rounded-xl border-2 border-red-200 bg-white shadow-lg overflow-hidden">
        <div class="px-4 py-3 bg-red-600">
            <h2 class="text-sm font-semibold text-white uppercase tracking-wider">Student list</h2>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-red-50 border-b-2 border-red-200">
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">Student No.</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">First Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">Last Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-red-800 uppercase align-top w-20"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr class="border-b border-gray-200 hover:bg-red-50/50">
                    <td class="px-4 py-3 text-left text-sm font-medium text-gray-900 align-top">{{ $student->student_number }}</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-700 align-top">{{ $student->first_name }}</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-700 align-top">{{ $student->last_name }}</td>
                    <td class="px-4 py-3 text-left text-sm text-gray-600 align-top">{{ $student->email }}</td>
                    <td class="px-4 py-3 text-left text-sm align-top">
                        <a href="{{ route('students.show', $student) }}" class="inline-block px-3 py-1.5 rounded-lg font-medium bg-red-600 text-white hover:bg-red-700 transition-colors">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-12 text-center text-sm text-gray-500">No students found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
