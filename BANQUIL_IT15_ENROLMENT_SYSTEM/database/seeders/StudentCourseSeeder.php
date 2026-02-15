<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentCourseSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['student_number' => '2021-001', 'first_name' => 'Maria', 'last_name' => 'Santos', 'email' => 'maria.santos@example.com'],
            ['student_number' => '2021-002', 'first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'email' => 'juan.delacruz@example.com'],
            ['student_number' => '2021-003', 'first_name' => 'Ana', 'last_name' => 'Reyes', 'email' => 'ana.reyes@example.com'],
            ['student_number' => '2022-001', 'first_name' => 'Carlos', 'last_name' => 'Garcia', 'email' => 'carlos.garcia@example.com'],
            ['student_number' => '2022-002', 'first_name' => 'Sofia', 'last_name' => 'Lopez', 'email' => 'sofia.lopez@example.com'],
        ];

        foreach ($students as $data) {
            Student::firstOrCreate(
                ['student_number' => $data['student_number']],
                $data
            );
        }

        $courses = [
            ['course_code' => 'IT15', 'course_name' => 'Web Development', 'capacity' => 3],
            ['course_code' => 'CS101', 'course_name' => 'Introduction to Programming', 'capacity' => 5],
            ['course_code' => 'MATH201', 'course_name' => 'Calculus I', 'capacity' => 4],
        ];

        foreach ($courses as $data) {
            Course::firstOrCreate(
                ['course_code' => $data['course_code']],
                $data
            );
        }

        $maria = Student::where('student_number', '2021-001')->first();
        $juan = Student::where('student_number', '2021-002')->first();
        $ana = Student::where('student_number', '2021-003')->first();
        $webDev = Course::where('course_code', 'IT15')->first();
        $prog = Course::where('course_code', 'CS101')->first();
        $calc = Course::where('course_code', 'MATH201')->first();

        if ($maria && $webDev && ! $maria->courses()->where('course_id', $webDev->id)->exists()) {
            $maria->courses()->attach($webDev->id);
        }
        if ($juan && $webDev && ! $juan->courses()->where('course_id', $webDev->id)->exists()) {
            $juan->courses()->attach($webDev->id);
        }
        if ($ana && $webDev && ! $ana->courses()->where('course_id', $webDev->id)->exists()) {
            $ana->courses()->attach($webDev->id);
        }
        if ($maria && $prog && ! $maria->courses()->where('course_id', $prog->id)->exists()) {
            $maria->courses()->attach($prog->id);
        }
        if ($juan && $calc && ! $juan->courses()->where('course_id', $calc->id)->exists()) {
            $juan->courses()->attach($calc->id);
        }
    }
}
