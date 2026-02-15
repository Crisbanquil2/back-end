<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="flex justify-center mb-6">
                <span class="flex items-center justify-center w-20 h-20 rounded-full bg-red-100 text-red-600 border-2 border-red-300">
                    <svg class="w-11 h-11" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                </span>
            </div>
            <h1 class="font-bold text-gray-900 leading-tight mb-3" style="font-size: clamp(1.75rem, 5vw, 3rem);">Welcome to the Mini Academic Portal</h1>
            <p class="text-gray-600 text-lg mb-10">Course &amp; enrollment system. Manage students and courses below.</p>
            <div class="flex flex-wrap gap-4 justify-center mt-8">
                <a href="{{ route('students.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl font-semibold text-white bg-red-600 hover:bg-red-700 shadow-md hover:shadow-lg transition-all">View Student</a>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl font-semibold text-white bg-red-600 hover:bg-red-700 shadow-md hover:shadow-lg transition-all">View Course</a>
            </div>
        </div>
    </div>
</x-app-layout>
