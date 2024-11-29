<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password','role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function courses()
    {
        // Check if the user has the 'student' role
        if ($this->role === 'student') {
            return $this->hasMany(Course::class);
        }

        // If the user is not a student, return an empty collection
        return collect();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    // Define relationship for the Teacher
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    // You can also define a method to check the role
    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

}
