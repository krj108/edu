<?php

namespace Modules\Subjects\App\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Subjects\App\Models\Subject;
use Modules\Classes\App\Models\ClassModel;
use Modules\Subjects\App\Services\SubjectLoggingService;
use Modules\Subjects\App\Http\Requests\StoreSubjectRequest;
use Modules\Subjects\App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    protected $loggingService;

    public function __construct(SubjectLoggingService $loggingService)
    {
        $this->middleware('auth:sanctum');
        $this->loggingService = $loggingService;
    }

    public function index()
    {
        return Subject::with('classes')->get();
    }

    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());
        $subject->classes()->sync($request->class_ids);

        $this->loggingService->logAction('created', $subject);
        return response()->json(['message' => 'Subject added successfully']);
    }

    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        $subject->classes()->sync($request->class_ids);

        $this->loggingService->logAction('updated', $subject);
        return response()->json(['message' => 'Subject updated successfully']);
    }

    public function destroy(Subject $subject)
    {
        $subject->classes()->detach();
        $subject->delete();

        $this->loggingService->logAction('deleted', $subject);
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}
