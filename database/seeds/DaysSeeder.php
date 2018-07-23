<?php

use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 13; $i++) {
            DB::table('days')->insert([
                'name' => $day[0],
                'email' => $day[1],
                'password' => bcrypt('aaaaaa')]);
        }
    }
}

