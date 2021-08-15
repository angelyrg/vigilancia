<?php

use App\Administrative;
use App\Attendance;
use App\Borrowing;
use App\Incident;
use App\Office;
use App\Support;
use App\Teacher;
use App\Vehicle;
use App\Visitor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolTableSeeder::class);
        $this->call(UserTableSeeder::class);


        factory(Teacher::class, 28)->create();
        factory(Administrative::class, 34)->create();
        factory(Office::class, 10)->create();
        factory(Visitor::class, 34)->create();
        factory(Vehicle::class, 20)->create();
        factory(Incident::class, 16)->create();
        factory(Borrowing::class, 21)->create();
        factory(Support::class, 32)->create();
        //factory(Attendance::class, 14)->create();

    }
}
