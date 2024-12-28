<?php

namespace Modules\Lessons\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Teacher');
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:classes,id',
            'room_id' => 'required|exists:rooms,id',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
            'pdf_link' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi|max:10240',
            'youtube_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_draft' => 'required|boolean',
        ];
    }
}
