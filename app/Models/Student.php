<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function level()
    {
        return $this->hasOne(Level::class);
    }
}
