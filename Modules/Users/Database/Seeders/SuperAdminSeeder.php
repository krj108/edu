<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder {
    public function run() {
    
        $superAdmin = User::firstOrCreate([
            'email' => 'superadmin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password'), 
        ]);
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdmin->assignRole($superAdminRole);
    }
}
