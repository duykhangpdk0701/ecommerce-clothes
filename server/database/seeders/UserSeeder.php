<?php

namespace Database\Seeders;

use App\Acl\Acl;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() > 0) {
            return false;
        }

        $superAdmin = User::withoutEvents(function () {
            return User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@hkp.vn',
                'password' => Hash::make('SuperAdmin@hkp99')
            ]);
        });
        $superAdmin2 = User::withoutEvents(function () {
            return User::create([
                'name' => 'Phung Khang',
                'email' => 'duykhangpdk0701@gmail.com',
                'password' => Hash::make('Pdk@073101')
            ]);
        });
        $admin = User::withoutEvents(function () {
            return User::create([
                'name' => 'Admin',
                'email' => 'admin@hkp.vn',
                'password' => Hash::make('Admin@hkp99')
            ]);
        });

        $staff = User::withoutEvents(function () {
            return User::create([
                'name' => 'Staff',
                'email' => 'staff@hkp.vn',
                'password' => Hash::make('Staff@hkp99')
            ]);
        });

        $customer = User::withoutEvents(function () {
            return User::create([
                'name' => 'Customer',
                'email' => 'customer@hkp.com',
                'password' => Hash::make('Customer@hkp99')
            ]);
        });

        $shipper = User::withoutEvents(function () {
            return User::create([
                'name' => 'Shipper',
                'email' => 'shipper@hkp.com',
                'password' => Hash::make('Shipper@hkp99')
            ]);
        });

        $superAdminRole = Role::findByName(Acl::ROLE_SUPER_ADMIN);
        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $staffRole = Role::findByName(Acl::ROLE_STAFF);
        $customerRole = Role::findByName(Acl::ROLE_CUSTOMER);
        $shipperRole = Role::findByName(Acl::ROLE_SHIPPER);

        //Sync Roles to seed accounts
        $superAdmin->syncRoles($superAdminRole);
        $superAdmin2->syncRoles($superAdminRole);
        $admin->syncRoles($adminRole);
        $staff->syncRoles($staffRole);
        $customer->syncRoles($customerRole);
        $shipper->syncRoles($shipperRole);
    }
}
