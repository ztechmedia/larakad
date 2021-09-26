<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassData extends Model
{
    protected $table = 'classes';
    protected $fillable = ['name', 'level_id'];

    //@kepunyaan level
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    //@punya banyak schedule
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public static function checkNameForUpdate($id, $level_id, $name): bool
    {
        return 0 === static::where('id', '!=', $id)
            ->where('level_id', $level_id)
            ->where('name', $name)->count();
    }
}
