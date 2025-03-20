<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            ProductSeeder::class,
        ]);
        $permissions = Permission::pluck('id','id')->all();
        $superadmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'role' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
        $roleSuperadmin = Role::where('name', 'superadmin')->first();
        $roleSuperadmin->syncPermissions($permissions);
        $superadmin->assignRole([$roleSuperadmin->id]);
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'edgyulnazaryandev@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleAdmin->syncPermissions($permissions);
        $admin->assignRole([$roleAdmin->id]);
    }
}
