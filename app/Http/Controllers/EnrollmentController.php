<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class EnrollmentController extends Controller
{
    public function index()
    {
        // Retrieve all enrollments with related student and course
        $enrollments = Enrollment::with(['student', 'course'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        // Get all students and courses for the form
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
        ]);

        // Create the enrollment
        Enrollment::create($request->all());

        return redirect()->route('enrollments.index')->with('message', 'Enrollment created successfully!');
    }

    public function destroy($id)
    {
        // Find and delete the enrollment
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('message', 'Enrollment deleted successfully!');
    }
}
