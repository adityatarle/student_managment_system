<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'description', 'duration'];
    protected $casts = [
        'duration' => 'integer', // Ensure that duration is treated as an integer
    ];
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function user()
{
    return $this->belongsTo(User::class); // Indicates that each course belongs to a user
}


}
