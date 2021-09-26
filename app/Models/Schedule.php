<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['subject_id', 'teacher_id', 'class_id', 'day', 'start', 'end', 'created_by'];
}
