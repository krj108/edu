<?php

namespace Modules\Subjects\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyTermRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'term_name' => 'required|string|max:255|unique:study_terms,term_name,' . $this->route('study_term')->id, // حقل حصري مع استثناء الحالي
        ];
    }
}
