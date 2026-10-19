<?php

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/display');
});

Route::get('/display', function () {
    $students = Student::query()->orderBy('name')->get();
    $courses = Course::query()->orderBy('course_name')->get();
    $enrollments = Enrollment::query()
        ->with(['student', 'course'])
        ->orderBy('enrollment_date', 'desc')
        ->get();

    return view('display', compact('students', 'courses', 'enrollments'));
});
