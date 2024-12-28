<?php

namespace Modules\Subjects\App\Services;

use Illuminate\Support\Facades\Log;
use Modules\Subjects\App\Models\Subject;

class SubjectLoggingService
{
    /**
     * Log an action for a given Subject.
     *
     * @param string $action
     * @param Subject $subject
     * @param int|null $userId
     */
    public function logAction(string $action, Subject $subject, ?int $userId = null): void
    {
        $userId = $userId ?? auth()->id();
        Log::info("Subject {$action} by user {$userId}", [
            'subject_id' => $subject->id,
            'subject_name' => $subject->name,
            'action' => $action,
            'user_id' => $userId,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
