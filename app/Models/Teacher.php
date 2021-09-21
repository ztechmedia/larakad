<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'nip', 'name', 'address', 'mobile', 'gender', 'last_education'];
}
