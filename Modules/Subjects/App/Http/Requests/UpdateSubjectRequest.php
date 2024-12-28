<?php
namespace Modules\Subjects\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:subjects,name,' . $this->route('subject')->id,
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:classes,id',
        ];
    }
}
