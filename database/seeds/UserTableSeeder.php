<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();

        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@wise.com";
        $user->password =  bcrypt('12345');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = "User";
        $user->email = "user@wise.com";
        $user->password = bcrypt('12345');
        $user->save();
        $user->roles()->attach($role_user);



    }
}
