<?php

namespace Modules\Users\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Users\App\Models\Teacher;
use Modules\Users\App\Http\Requests\StoreTeacherRequest;
use Modules\Users\App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::with(['user', 'subjects', 'classes', 'rooms'])->get();
    }

    public function store(StoreTeacherRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole('Teacher');

        $teacher = Teacher::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile_image' => $request->file('profile_image')?->store('profile_images'),
        ]);

        $teacher->subjects()->sync($request->subject_ids);
        $teacher->classes()->sync($request->class_ids);
        $teacher->rooms()->sync($request->room_ids);

        return response()->json(['message' => 'Teacher created successfully']);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        $teacher->subjects()->sync($request->subject_ids);
        $teacher->classes()->sync($request->class_ids);
        $teacher->rooms()->sync($request->room_ids);

        return response()->json(['message' => 'Teacher updated successfully']);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
