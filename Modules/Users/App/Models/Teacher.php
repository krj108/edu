<?php

namespace Modules\Users\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\Subjects\App\Models\Subject;
use Modules\Classes\App\Models\ClassModel;
use Modules\Classes\App\Models\Room;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'phone', 'address', 'profile_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject');
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'teacher_class', 'teacher_id', 'class_id');
    }
    

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'teacher_room', 'teacher_id', 'room_id');
    }
}
