<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $role1=Role::create(['name'=>'Super Admin']);
        $permissions=['admin','role','permission'];
        foreach ($permissions as $key => $permission) {
            $s='s';
            Permission::create(['name'=>"view $permission$s"]);
            Permission::create(['name'=>"create $permission"]);
            Permission::create(['name'=>"update $permission"]);
            Permission::create(['name'=>"delete $permission"]);
            if ($permission=='role') {
                Permission::create(['name'=>"role permissions"]);
            }
        }
        $permission2=['users','albums'];
        foreach ($permission2 as $key => $permission) {
            Permission::create(['name'=>"view all $permission"]);
            Permission::create(['name'=>"delete $permission"]);
        }
        $permission3=['setting','dashboard'];
        foreach ($permission3 as $key => $permission) {
            Permission::create(['name'=>"$permission"]);
        }
        $super=User::create(['name'=>'Super Admin','password'=>bcrypt('12345678'),'email'=>'superadmin@example.com']);
        $super->assignRole($role1);
        $role2=Role::create(['name'=>'Admin']);
        $role2->syncPermissions(['setting','dashboard','delete albums','view all users','view all albums']);
        for ($i=1; $i <= 10; $i++) {
            $admin=User::create(['name'=>"Admin$i",'password'=>bcrypt('12345678'),'email'=>"admin$i@example.com"]);
            $admin->assignRole($role2);  
        }
        $role3=Role::create(['name'=>'User']);
        for ($i=1; $i <= 100; $i++) {
            $user=User::create(['name'=>"User$i",'password'=>bcrypt('12345678'),'email'=>"user$i@example.com"]);
            $user->assignRole($role3);
        }
    }

}
