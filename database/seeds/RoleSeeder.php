<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $retailer_roles = ['restaurant', 'shop', 'grocery'];
        $user_roles = ['std_user', 'publisher', 'administrator'];

        /* 'web' guard roles */
        foreach ($retailer_roles as $role_name) {
            if (Role::where('name', $role_name)->where('guard_name', 'web')->first() == null) {
                $role = new Role;
                $role->name = $role_name;
                $role->guard_name = 'web';
                $role->save();
            }
        }

        foreach ($user_roles as $role_name) {
            if (Role::where('name', $role_name)->where('guard_name', 'web')->first() == null) {
                $role = new Role;
                $role->name = $role_name;
                $role->guard_name = 'web';
                $role->save();
            }
        }

        /* 'api' guard roles */
        foreach ($retailer_roles as $role_name) {
            if (Role::where('name', $role_name)->where('guard_name', 'api')->first() == null) {
                $role = new Role;
                $role->name = $role_name;
                $role->guard_name = 'api';
                $role->save();
            }
        }

        foreach ($user_roles as $role_name) {
            if (Role::where('name', $role_name)->where('guard_name', 'api')->first() == null) {
                $role = new Role;
                $role->name = $role_name;
                $role->guard_name = 'api';
                $role->save();
            }
        }
    }
}
