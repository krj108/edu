<?php

namespace Modules\Classes\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Classes\Database\factories\RoomFactory;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['class_id', 'name'];
    
    // protected static function newFactory(): RoomFactory
    // {
    //     //return RoomFactory::new();
    // }

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}
