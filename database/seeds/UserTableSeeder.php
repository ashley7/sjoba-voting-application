<?php

use Illuminate\Database\Seeder;
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

        // User::saveUser( "Kule Lawrence","0779217566","1231","admin");           
        User::saveUser( "Vincent Otti","0753735383","1237","admin");           

    }
}
