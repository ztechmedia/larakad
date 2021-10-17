<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'created_by'];

    //@punya banyak schedule
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
