<?php

namespace Modules\Classes\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:classes,name|max:255',
        ];
    }
}
