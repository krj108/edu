<?php

namespace Modules\Classes\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Classes\Database\factories\ClassModelFactory;
use Modules\Subjects\App\Models\Subject;
class ClassModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];
    protected $table = 'classes';
    // protected static function newFactory(): ClassModelFactory
    // {
    //     //return ClassModelFactory::new();
    // }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject');
    }
    
}
