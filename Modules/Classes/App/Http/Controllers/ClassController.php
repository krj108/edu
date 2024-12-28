<?php
namespace Modules\Classes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Classes\App\Models\ClassModel;
use Modules\Classes\App\Http\Requests\StoreClassRequest;
use Modules\Classes\App\Http\Requests\UpdateClassRequest;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return ClassModel::all();
    }

    public function store(StoreClassRequest $request)
    {
        ClassModel::create($request->validated());
        return response()->json(['message' => 'Class added successfully']);
    }

    public function update(UpdateClassRequest $request, ClassModel $class)
    {
        $validatedData = $request->validated();
        $class->update($validatedData);
    
        return response()->json(['message' => 'Class updated successfully']);
    }
    

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return response()->json(['message' => 'Class deleted successfully']);
    }
}
