<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $students = [
            ['student_number' => '2024-001', 'name' => 'Alice Johnson', 'email' => 'alice@example.com', 'phone' => '0917-111-1111'],
            ['student_number' => '2024-002', 'name' => 'Brian Smith', 'email' => 'brian@example.com', 'phone' => '0917-222-2222'],
            ['student_number' => '2024-003', 'name' => 'Carla Gomez', 'email' => 'carla@example.com', 'phone' => '0917-333-3333'],
            ['student_number' => '2024-004', 'name' => 'Daniel Lee', 'email' => 'daniel@example.com', 'phone' => '0917-444-4444'],
        ];

        foreach ($students as $student) {
            Student::query()->create($student);
        }

        $courses = [
            ['course_code' => 'CS101', 'course_name' => 'Intro to Programming', 'units' => 3],
            ['course_code' => 'MATH201', 'course_name' => 'Discrete Mathematics', 'units' => 4],
            ['course_code' => 'ENG102', 'course_name' => 'Technical Writing', 'units' => 2],
        ];

        foreach ($courses as $course) {
            Course::query()->create($course);
        }

        $studentRecords = Student::query()->pluck('id', 'student_number')->all();
        $courseRecords = Course::query()->pluck('id', 'course_code')->all();

        $enrollments = [
            ['student_number' => '2024-001', 'course_code' => 'CS101', 'enrollment_date' => '2026-08-01'],
            ['student_number' => '2024-001', 'course_code' => 'MATH201', 'enrollment_date' => '2026-08-02'],
            ['student_number' => '2024-002', 'course_code' => 'CS101', 'enrollment_date' => '2026-08-01'],
            ['student_number' => '2024-002', 'course_code' => 'ENG102', 'enrollment_date' => '2026-08-03'],
            ['student_number' => '2024-003', 'course_code' => 'MATH201', 'enrollment_date' => '2026-08-02'],
            ['student_number' => '2024-004', 'course_code' => 'ENG102', 'enrollment_date' => '2026-08-04'],
        ];

        foreach ($enrollments as $enrollment) {
            Enrollment::query()->create([
                'student_id' => $studentRecords[$enrollment['student_number']],
                'course_id' => $courseRecords[$enrollment['course_code']],
                'enrollment_date' => $enrollment['enrollment_date'],
            ]);
        }
    }
}
