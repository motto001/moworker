<?php

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
        $this->call(DaytypesSeeder::class);
        $this->call(TimetypesSeeder::class);
        $this->call(DaysSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(WorkersSeeder::class);
        $this->call(RolesSeeder::class);
        
    } 
}
