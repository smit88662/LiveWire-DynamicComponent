<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_name', 'college_email', 'university_name', 'college_contact', 'college_person', 'college_website'
    ];

    public function universities()
    {
        return $this->belongsTo(University::class, 'university_name', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'student_name', 'id');
    }
}
