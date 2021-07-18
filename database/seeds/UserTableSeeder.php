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

        // User::saveUser( "Kule Lowrence","0779217566","1231","admin");           
        User::saveUser( "Mbusa Joseph","0755205108","1237","admin");           

    }
}
