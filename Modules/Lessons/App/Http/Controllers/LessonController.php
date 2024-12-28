<?php

namespace Modules\Lessons\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Lessons\App\Models\Lesson;
use Modules\Lessons\App\Http\Requests\StoreLessonRequest;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $lessons = Lesson::query()
            ->when(
                $user->hasRole('Teacher'),
                fn ($query) => $query->where('teacher_id', $user->teacher->id)
            )
            ->when(
                $user->hasRole('Admin'),
                fn ($query) => $query
            )
            ->where('is_draft', false)
            ->with(['teacher', 'subject', 'class', 'room'])
            ->get();

        return response()->json($lessons);
    }

    public function store(StoreLessonRequest $request)
    {
        $teacher = auth()->user()->teacher;

       
        $teacher->classes()->findOrFail($request->class_id);
        $teacher->rooms()->findOrFail($request->room_id);
        $teacher->subjects()->findOrFail($request->subject_id);

        $imagePath = $request->file('image')?->store('lessons/images', 'public');

        $lesson = Lesson::create([
            'title' => $request->title,
            'content' => $request->content,
            'teacher_id' => $teacher->id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'room_id' => $request->room_id,
            'pdf_file' => $request->file('pdf_file')?->store('lessons/pdfs'),
            'pdf_link' => $request->pdf_link,
            'video_file' => $request->file('video_file')?->store('lessons/videos'),
            'youtube_link' => $request->youtube_link,
            'is_draft' => $request->is_draft,
        ]);

        return response()->json(['message' => 'Lesson created successfully', 'lesson' => $lesson]);
    }

    public function update(StoreLessonRequest $request, Lesson $lesson)
    {
    
        $this->authorize('update', $lesson);
    
        $data = $request->only([
            'title', 'content', 'subject_id', 'class_id', 'room_id', 'is_draft',
        ]);
    
      
        $teacher = auth()->user()->teacher;
        $teacher->classes()->findOrFail($data['class_id']);
        $teacher->rooms()->findOrFail($data['room_id']);
        $teacher->subjects()->findOrFail($data['subject_id']);
    
   
        if ($request->hasFile('image')) {
            if ($lesson->image) {
                Storage::disk('public')->delete($lesson->image);
            }
            $data['image'] = $request->file('image')->store('lessons/images', 'public');
        }
    
        if ($request->hasFile('pdf_file')) {
            if ($lesson->pdf_file) {
                Storage::delete($lesson->pdf_file);
            }
            $data['pdf_file'] = $request->file('pdf_file')->store('lessons/pdfs');
        }
    
        if ($request->hasFile('video_file')) {
            if ($lesson->video_file) {
                Storage::delete($lesson->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('lessons/videos');
        }
    
       
        if ($request->filled('pdf_link')) {
            $data['pdf_link'] = $request->pdf_link;
        }
        if ($request->filled('youtube_link')) {
            $data['youtube_link'] = $request->youtube_link;
        }
    
     
        $lesson->update($data);
    
        return response()->json(['message' => 'Lesson updated successfully', 'lesson' => $lesson]);
    }
    


    public function destroy(Lesson $lesson)
    {
        $this->authorize('delete', $lesson);

        if ($lesson->pdf_file) {
            Storage::delete($lesson->pdf_file);
        }

        if ($lesson->video_file) {
            Storage::delete($lesson->video_file);
        }

        if ($lesson->image) {
            Storage::disk('public')->delete($lesson->image);
        }

        $lesson->delete();

        return response()->json(['message' => 'Lesson deleted successfully']);
    }
}
