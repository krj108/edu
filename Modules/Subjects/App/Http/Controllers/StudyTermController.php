<?php

namespace Modules\Subjects\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Subjects\App\Models\StudyTerm;
use Modules\Subjects\App\Services\StudyTermService;
use Modules\Subjects\App\Http\Requests\StoreStudyTermRequest;
use Modules\Subjects\App\Http\Requests\UpdateStudyTermRequest;

class StudyTermController extends Controller
{
    protected $studyTermService;

    public function __construct(StudyTermService $studyTermService)
    {
        $this->middleware('auth:sanctum');
        $this->studyTermService = $studyTermService;
    }

    public function index()
    {
        return StudyTerm::all();
    }

    public function store(StoreStudyTermRequest $request)
    {
        $studyTerm = $this->studyTermService->create($request->validated());
        return response()->json(['message' => 'Study Term added successfully', 'study_term' => $studyTerm]);
    }

    public function update(UpdateStudyTermRequest $request, StudyTerm $studyTerm)
    {
        $updatedTerm = $this->studyTermService->update($studyTerm, $request->validated());
        return response()->json(['message' => 'Study Term updated successfully', 'study_term' => $updatedTerm]);
    }

    public function destroy(StudyTerm $studyTerm)
    {
        $this->studyTermService->delete($studyTerm);
        return response()->json(['message' => 'Study Term deleted successfully']);
    }
}
