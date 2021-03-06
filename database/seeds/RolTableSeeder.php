<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'vigilante';
        $role->description = 'Vigilante';
        $role->save();
    }
}
