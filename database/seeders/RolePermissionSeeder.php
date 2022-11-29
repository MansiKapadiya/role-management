<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            [
                'group_name'  => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ],
            ],
            [
                'group_name'  => 'role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete'
                ],
            ],
            [
                'group_name'  => 'category',
                'permissions' => [
                    // Category Permissions
                    'category.create',
                    'category.view',
                    'category.edit',
                    'category.delete'
                ],
            ],
            [
                'group_name'  => 'product',
                'permissions' => [
                    // Product Permissions
                    'product.create',
                    'product.view',
                    'product.edit',
                    'product.delete'
                ],
            ],
            [
                'group_name'  => 'order',
                'permissions' => [
                    // Order Permissions
                    'order.view',
                    'order.delete'
                ],
            ],
            [
                'group_name'  => 'stock',
                'permissions' => [
                    // Stock Permissions
                    'stock.create',
                    'stock.view',
                    'stock.edit',
                    'stock.delete'
                ],
            ],
            [
                'group_name'  => 'subadmin',
                'permissions' => [
                    // subadmin Permissions
                    'subadmin.create',
                    'subadmin.view',
                    'subadmin.edit',
                    'subadmin.delete'
                ],
            ],

        ];

        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'admin']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = Admin::where('username', 'superadmin')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }

    }
}
