<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'dashboard-access',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Give all permissions to Super Admin
        $superAdminRole->givePermissionTo(Permission::all());

        // Give limited permissions to Admin
        $adminRole->givePermissionTo([
            'dashboard-access',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',
            'user-list',
            'user-edit',
            'user-create',
            'user-delete',
        ]);

        // Give basic permissions to User
        $userRole->givePermissionTo([
            'dashboard-access',
            'product-list',
            'category-list',
            'order-list',
        ]);
    }
}
