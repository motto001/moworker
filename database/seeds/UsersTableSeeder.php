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
        $users=[['root','root@dolgozo.com'],['manager','manager@dolgozo.com']
        ,['workadmin','workadmin@dolgozo.com'],['workadmin2','workadmin2@dolgozo.com']
        ,['worker','worker@dolgozo.com'],['worker2','worker2@dolgozo.com'],['worker3','worker3@dolgozo.com']];
        foreach($users as $user){
              DB::table('users')->insert([
            'name' => $user[0],
            'email' => $user[1],
            'password' => bcrypt('aaaaaa'),
        ]);
        }
      ;
    }
}
