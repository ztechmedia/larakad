<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'Admin';
        $adminRole->save();

        $studentRole= new Role();
        $studentRole->name = 'student';
        $studentRole->display_name = 'Murid';
        $studentRole->save();

        $studentRole= new Role();
        $studentRole->name = 'teacher';
        $studentRole->display_name = 'Guru';
        $studentRole->save();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('janxploit');
        $admin->save();
        $admin->attachRole($adminRole);
    }
}
