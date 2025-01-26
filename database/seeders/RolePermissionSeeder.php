<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'superAdmin', 'guard_name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager', 'guard_name' => 'admin']);

        $permissions_data = [
            [
                'module_name' => 'Dashboard',
                'guard_name' => 'admin',
                'permissions' => ['dashboard-show']
            ],
            [
                'module_name' => 'Airticket',
                'guard_name' => 'admin',
                'permissions' => [
                    'airticket-create',
                    'airticket-list',
                    'airticket-show',
                    'airticket-edit',
                    'airticket-delete',
                    'airticket-report'
                ]
            ],
            [
                'module_name' => 'Hotelticket',
                'guard_name' => 'admin',
                'permissions' => [
                    'hotelticket-create',
                    'hotelticket-list',
                    'hotelticket-show',
                    'hotelticket-edit',
                    'hotelticket-delete',
                    'hotelticket-report'
                ]
            ],
            [
                'module_name' => 'Customer',
                'guard_name' => 'admin',
                'permissions' => [
                    'customer-create',
                    'customer-list',
                    'customer-show',
                    'customer-edit',
                    'customer-delete'
                ]
            ],
        ];
        foreach ($permissions_data as $permission_data) {
            $module_name = $permission_data['module_name'];
            $guard_name = $permission_data['guard_name'];

            foreach ($permission_data['permissions'] as $permission) {
                Permission::create([
                    'name' => $permission,
                    'guard_name' => $guard_name,
                    'module_name' => $module_name
                ]);
            }
        }


        //give all permission to superadmin
        $superAdminRole->syncPermissions(Permission::all());

        $superAdmin = Admin::Create(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'phone' => '01755555555',
                'password' => Hash::make('12345678'),
                'username' => 'superadmin',
                'address' => 'Dhaka, Bangladesh'
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        $manager = Admin::Create(
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'phone' => '017555554445',
                'password' => Hash::make('12345678'),
                'username' => 'manager',
                'address' => 'Dhaka, Bangladesh'
            ]
        );
        $manager->assignRole($managerRole);
    }
}
