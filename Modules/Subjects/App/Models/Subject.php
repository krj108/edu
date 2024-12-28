<?php

namespace Modules\Subjects\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Classes\App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subjects\Database\factories\SubjectFactory;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ["name"];
    
    // protected static function newFactory(): SubjectFactory
    // {
    //     //return SubjectFactory::new();
    // }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_subject', 'subject_id', 'class_id');
    }
    
}
