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
        $user->role_id = '1';

        $user->contract_start = '2000-01-01';
        $user->contract_end = '9999-12-31';

        //$user->active = 1; //Default 1
        $user->password = bcrypt('12345678');
        $user -> save();
        

        $user = new User();
        $user->name = 'Vigilante';
        $user->lastname = '-';
        $user->dni = '00000000';
        $user->phone = '987654321';
        $user->role_id = '2';

        $user->contract_start = '2018-01-01';
        $user->contract_end = '2021-12-31';

        //$user->active = 1; //Default 1
        $user->password = bcrypt('00000000');
        $user -> save();


        factory(User::class, 5)->create();
        
    }
}
