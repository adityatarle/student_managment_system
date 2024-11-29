<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['student_id', 'teacher_id', 'title', 'description', 'due_date', 'status', 'file'];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function toggleStatus()
    {
        $this->status = $this->status === 'Pending' ? 'Completed' : 'Pending';
        $this->save();
    }


}
