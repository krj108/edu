<?php

namespace Modules\Users\App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Modules\Users\App\Models\Admin;
use Illuminate\Http\Request;
use Modules\Users\Services\ImageService;
use Modules\Users\App\Http\Requests\StoreAdminRequest;
use Modules\Users\App\Http\Requests\UpdateAdminRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    protected $imageService;
    use AuthorizesRequests;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->middleware('role:Super Admin')->only('destroy');
    }

    /**
     * Display a listing of the admins.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
      
        $admins = Admin::with('user:id,name,email')->paginate(10); // تقسيم النتائج لزيادة الأداء

        return response()->json($admins);
    }

    /**
     * Display the specified admin by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
      
        $admin = Admin::with('user:id,name,email')->findOrFail($id);

        return response()->json($admin);
    }

    /**
     * Store a new admin user.
     *
     * @param StoreAdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAdminRequest $request)
    {
        $avatarPath = $this->imageService->storeAvatar($request->file('avatar'));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('Admin');

        Admin::create([
            'user_id' => $user->id,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'avatar' => $avatarPath,
        ]);

        return response()->json(['message' => 'Admin created successfully']);
    }

    /**
     * Update an existing admin user profile.
     *
     * @param UpdateAdminRequest $request
     * @param int $adminId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAdmin(UpdateAdminRequest $request, $adminId)
    {
        Log::info('Updating admin profile', ['adminId' => $adminId]);
    
        $admin = Admin::findOrFail($adminId);
        $this->authorize('update', $admin);
    
        Log::info('Authorized update for admin', ['adminId' => $adminId]);
    
        $updatedUser = $admin->user->update(array_filter([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : null,
        ]));
    
        Log::info('User updated', ['updatedUser' => $updatedUser]);
    
        if ($request->hasFile('avatar')) {
            $admin->avatar = $this->imageService->storeAvatar($request->file('avatar'), $admin->avatar);
            Log::info('Avatar updated', ['avatarPath' => $admin->avatar]);
        }
    
        $updatedAdmin = $admin->update([
            'mobile' => $request->mobile,
            'address' => $request->address,
        ]);
    
        Log::info('Admin fields updated', ['updatedAdmin' => $updatedAdmin]);
    
        if ($updatedUser || $updatedAdmin) {
            return response()->json(['message' => 'Admin profile updated successfully']);
        } else {
            return response()->json(['message' => 'Failed to update admin profile'], 500);
        }
    }

    /**
     * Remove the specified admin.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // حذف المستخدم ومسؤولته
        $admin->user->delete(); // حذف المستخدم مع دور الأدمن
        $admin->delete(); // حذف سجل الأدمن نفسه

        return response()->json(['message' => 'Admin deleted successfully']);
    }
}
