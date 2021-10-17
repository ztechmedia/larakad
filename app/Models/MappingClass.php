<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MappingClass extends Model
{
    protected $fillable = ['student_id', 'class_id', 'year', 'created_by'];

    //@kepunyaan student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    //@kepunyaan classes
    public function classes()
    {
        return $this->belongsTo(CalssData::class);
    }
    
}
