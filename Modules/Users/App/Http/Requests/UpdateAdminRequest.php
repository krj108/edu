<?php
namespace Modules\Users\App\Http\Requests;
use Modules\Users\App\Models\Admin;
use Illuminate\Foundation\Http\FormRequest;
class UpdateAdminRequest extends FormRequest {
  // UpdateAdminRequest.php
// UpdateAdminRequest.php
public function authorize()
{
    $adminId = $this->route('admin');
    $userId = auth()->id();         
    return auth()->user()->hasRole('Super Admin') || Admin::where('id', $adminId)->where('user_id', $userId)->exists();
}

public function rules()
{
    return [
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|unique:users,email,' . $this->route('admin'),
        'password' => 'nullable|min:8',
        'mobile' => 'nullable|string',
        'address' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];
}

}
