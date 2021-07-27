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

        $user = new User();
        $user->name = 'Admin';
        $user->lastname = '-';
        $user->dni = '12345678';
        $user->phone = '123456789';
        // $user->email = 'admin@admin.com';
        $user->role_id = '1';
        //$user->active = 1;
        $user->password = bcrypt('12345678');
        $user -> save();
        

        $user = new User();
        $user->name = 'Vigilante';
        $user->lastname = '-';
        $user->dni = '00000000';
        $user->phone = '987654321';
        // $user->email = 'vigilante@gmail.com';
        $user->role_id = '2';
        //$user->active = 1;
        $user->password = bcrypt('00000000');
        $user -> save();
        
    }
}
