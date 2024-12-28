<?php
namespace Modules\Subjects\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:subjects,name|max:255',
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:classes,id',
        ];
    }
}

