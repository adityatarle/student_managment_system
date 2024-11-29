<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name','email','date_of_birth', 'phone', 'address', 'user_id'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
