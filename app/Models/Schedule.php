<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['subject_id', 'teacher_id', 'class_id', 'day', 'start', 'end', 'semester', 'year', 'created_by'];
    
    //@kepunyaan subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    //@kepunyaan teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    //@kepunyaan classes
    public function classes()
    {
        return $this->belongsTo(ClassData::class);
    }
}
