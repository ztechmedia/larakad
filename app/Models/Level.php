<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'stand_for'];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function classData()
    {
        return $this->hasMany(ClassData::class);
    }
}
