<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class StudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = Student::all();  // Fetch all students
        return view('students.index', compact('students'));
    }

    // Show the form for creating a new student
    public function create()
    {
        return view('students.create');
    }

    // Store a newly created student
        public function store(Request $request)
    {
        // Define custom error messages
        $messages = [
            'email.unique' => 'The email address is already in use.',
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'date_of_birth.required' => 'The date of birth field is required.',
            'phone.required' => 'The phone number field is required.',
            'address.required' => 'The address field is required.',
            'email.email' => 'The email address must be a valid email address.',
            'phone.max' => 'The phone number may not be greater than 15 characters.',
        ];

        // Validate the request with custom messages
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|unique:users,email', // Ensure unique email in both students and users table
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ], $messages);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'), // Set default password
            'role' => 'teacher', // Explicitly set role as 'teacher'
        ]);
        // Create a new teacher record in the teachers table
        $student = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'date_of_birth' => $validated['date_of_birth'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'user_id' => $user->id
        ]);

            return redirect()->route('students.index')->with('message', 'Student added successfully, and user credentials stored in users table!');

    }


    // Show the form for editing a student
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // Update a student's information
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('message', 'Student updated successfully!');
    }

    public function show($id)
    {
        // Retrieve student along with their enrollments and tasks
        $student = Student::with(['enrollments.course', 'tasks.teacher'])->findOrFail($id);

        // Return the student details view
        return view('students.show', compact('student'));
    }


    // Delete a student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('message', 'Student deleted successfully!');
    }

    public function show_profile($id)
    {
        $student = Student::with(['enrollments.course', 'tasks.teacher'])->findOrFail($id);
        return view('students.show', compact('student'));
    }

}
