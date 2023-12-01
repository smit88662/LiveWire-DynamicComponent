<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name', 'university_name', 'student_image',
        'college_name', 'student_email', 'student_address', 'student_contact'
    ];

    protected $casts = [
        'student_image' => 'array',
        'student_certificate_image' => 'array'
    ];

    public function colleges()
    {
        return $this->belongsTo(College::class, 'college_name', 'id');
    }

    public function universities()
    {
        return $this->belongsTo(University::class, 'university_name', 'id');
    }
}
