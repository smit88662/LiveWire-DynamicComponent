<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_name',
        'university_type',
        'university_email',
        'university_contact',
        'university_person',
        'branch',
        'university_website',
        'academicprograms',
    ];

    protected $casts = [
        'branch' => 'json',
        'academicprograms' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
