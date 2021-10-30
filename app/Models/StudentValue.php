<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentValue extends Model
{
    protected $fillable = ['student_id', 'class_id', 'subject_id', 'semester', 'year', 'value', 'created_by'];

    //@kepunyaan student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    //@kepunyaan class
    public function classes()
    {
        return $this->belongsTo(ClassData::class);
    }

    //@kepunyaan subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
