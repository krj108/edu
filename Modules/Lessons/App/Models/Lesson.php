<?php

namespace Modules\Lessons\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\App\Models\Teacher;
use Modules\Subjects\App\Models\Subject;
use Modules\Classes\App\Models\ClassModel;
use Modules\Classes\App\Models\Room;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'teacher_id', 'subject_id',
        'class_id', 'room_id', 'pdf_file', 'pdf_link',
        'video_file', 'youtube_link', 'is_draft',  'image',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
