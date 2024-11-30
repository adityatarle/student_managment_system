<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        // Retrieve all tasks with related student and teacher
        $tasks = Task::with(['student', 'teacher'])->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        // Get all students and teachers for the form
        $students = Student::all();
        $teachers = Teacher::all();
        return view('tasks.create', compact('students', 'teachers'));
    }

    public function store(Request $request)
{
    // Validate the data
    $request->validate([
        'student_id' => 'required|exists:students,id',
        'teacher_id' => 'required|exists:teachers,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'due_date' => 'required|date',
        'status' => 'required|in:Pending,Completed',
        'file' => 'nullable|mimes:pdf,doc,docx|max:2048'
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filePath = $file->store('task_files', 'public'); // Store the file in the 'task_files' directory
    }


    try {
        // Create the task
        Task::create([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'file' => $filePath, // Save file path to database
        ]);

        // Redirect with success message
        return redirect()->route('tasks.index')->with('message', 'Task created successfully!');

    } catch (\Exception $e) {
        // Redirect back with error message
        return redirect()->back()->with('error', 'Something went wrong. Please try again!');
    }
}


    public function destroy($id)
    {
        // Find and delete the task
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully!');
    }

    public function toggleStatus(Task $task)
    {
        $task->toggleStatus();
        return response()->json(['status' => $task->status, 'message' => 'Status updated successfully.']);
    }
}
