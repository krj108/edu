<?php

namespace Modules\Classes\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:classes,id',
        ];
    }
}
