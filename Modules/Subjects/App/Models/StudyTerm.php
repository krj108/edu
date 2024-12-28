<?php

namespace Modules\Subjects\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subjects\Database\factories\StudyTermFactory;

class StudyTerm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['term_name'];
    
    // protected static function newFactory(): StudyTermFactory
    // {
    //     //return StudyTermFactory::new();
    // }
}
