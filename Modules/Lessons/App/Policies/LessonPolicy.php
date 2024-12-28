<?php

namespace Modules\Lessons\App\Policies;

use App\Models\User;
use Modules\Lessons\App\Models\Lesson;

class LessonPolicy
{
    public function delete(User $user, Lesson $lesson)
    {
        return $user->hasRole('Admin') || $user->id === $lesson->teacher->user_id;
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $user->hasRole('Teacher') && $user->id === $lesson->teacher->user_id;
    }
}
