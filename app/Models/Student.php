<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = ['id'];

    //@kepunyaan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //@kepunyaan level
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
