<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [1,'root', 'root@dolgozo.com'],
            [2,'manager', 'manager@dolgozo.com'],
            [3,'workadmin', 'workadmin@dolgozo.com'],
            [4,'workadmin2', 'workadmin2@dolgozo.com'],
            [5,'user', 'user@dolgozo.com'],
            [6,'user2', 'user2@dolgozo.com'],
            [7,'noworker user', 'noworker.user@dolgozo.com']
        ];
        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user[0],
                'name' => $user[1],
                'email' => $user[2],
                'password' => bcrypt('aaaaaa'),
            ]);
        }
        ;
    }
}
