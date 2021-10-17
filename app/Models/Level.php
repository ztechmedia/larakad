<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['name', 'stand_for', 'created_by'];

    //@punya banyak student
    public function student()
    {
        return $this->hasMany(Student::class);
    }

    //@punya banyak class
    public function classData()
    {
        return $this->hasMany(ClassData::class);
    }
}
