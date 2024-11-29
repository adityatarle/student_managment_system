<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;

class CourseController extends Controller
{public function index()
    {
        $courses = Course::all(); // Get all courses
        return view('courses.index', compact('courses')); // Pass courses to view
    }

    // Show form to create a new course
    public function create()
    {
        return view('courses.create');
    }

    // Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        Course::create($request->all()); // Create a new course

        return redirect()->route('courses.index')->with('message', 'Course added successfully!');
    }

    // Show form to edit a course
    public function edit($id)
    {
        $course = Course::findOrFail($id); // Find course by ID
        return view('courses.edit', compact('course'));
    }

    // Update a course
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        $course = Course::findOrFail($id); // Find course by ID
        $course->update($request->all()); // Update the course data

        return redirect()->route('courses.index')->with('message', 'Course updated successfully!');
    }

    // Delete a course
    public function destroy($id)
    {
        $course = Course::findOrFail($id); // Find course by ID
        $course->delete(); // Delete the course

        return redirect()->route('courses.index')->with('message', 'Course deleted successfully!');
    }
}
