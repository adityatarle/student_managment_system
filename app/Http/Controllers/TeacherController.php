<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email|unique:users,email', // Ensure unique in both tables
        ]);



        // Create the associated user record with a default password and role as 'teacher'
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'), // Set default password
            'role' => 'teacher', // Explicitly set role as 'teacher'
        ]);
        // Create a new teacher record in the teachers table
        $teacher = Teacher::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'user_id' => $user->id
        ]);



        // Redirect with a success message
        return redirect()->route('teachers.index')->with('message', 'Teacher added successfully, credentials stored in users table!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Show the form to edit the teacher's information
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id); // Fetch the teacher by id
        return view('teachers.edit', compact('teacher')); // Return the edit view
    }

    // Handle the update of teacher's information
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
        ]);

        $teacher = Teacher::findOrFail($id); // Fetch the teacher

        // Update teacher's data
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Redirect to the teacher's list with a success message
        return redirect()->route('teachers.index')->with('message', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teachers.index')->with('message', 'Teacher deleted successfully.');
    }

}
