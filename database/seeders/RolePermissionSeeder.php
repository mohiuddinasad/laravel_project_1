<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'manager', 'editor', 'viewer'];
        foreach($roles as $role){
            Role::firstOrCreate(
                ['name' => $role],
                ['guard_name' => 'web']
            );
        }

        $permissions = ['create', 'edit', 'delete', 'view'];
        foreach($permissions as $permission){
            Permission::firstOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }
    }
}
