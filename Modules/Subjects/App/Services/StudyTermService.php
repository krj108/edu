<?php

namespace Modules\Subjects\App\Services;

use Modules\Subjects\App\Models\StudyTerm;

class StudyTermService
{
    public function create(array $data): StudyTerm
    {
        return StudyTerm::create($data);
    }

    public function update(StudyTerm $studyTerm, array $data): StudyTerm
    {
        $studyTerm->update($data);
        return $studyTerm;
    }

    public function delete(StudyTerm $studyTerm): void
    {
        $studyTerm->delete();
    }
}
