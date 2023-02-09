<?php

namespace Database\Seeders;

use App\Acl\Acl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (Acl::roles() as $role) {
            Role::findOrCreate($role);
        }

        foreach (Acl::permissions() as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdminRole = Role::findByName(Acl::ROLE_SUPER_ADMIN);
        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $staffRole = Role::findByName(Acl::ROLE_STAFF);
        $shipperRole = Role::findByName(Acl::ROLE_SHIPPER);
        $customerRole = Role::findByName(Acl::ROLE_CUSTOMER);

        $superAdminRole->givePermissionTo(Acl::permissions());
        $adminRole->givePermissionTo(Acl::permissions([Acl::PERMISSION_PERMISSION_MANAGE]));
        $staffRole->givePermissionTo([
            Acl::PERMISSION_VIEW_MENU_STAFF,
            Acl::PERMISSION_VIEW_MENU_DASHBOARD,
            Acl::PERMISSION_USER_LIST,
        ]);
        $shipperRole->givePermissionTo([
            Acl::PERMISSION_VIEW_MENU_DASHBOARD,
            Acl::PERMISSION_ORDER_LIST,
            Acl::PERMISSION_ORDER_ADD,
            Acl::PERMISSION_ORDER_EDIT,
            Acl::PERMISSION_ORDER_DELETE,
        ]);
    }
}
