<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[['admin','Admin'],['manager','Manager']
        ,['workadmin','Workadmin'],['worker','Worker']];
        foreach($roles as $role){
              DB::table('roles')->insert([
            'name' => $role[0],
            'label' => $role[1],
        ]);
        };

        $roleusers=[
        [1,1],[1,2],[1,3],[1,4],  //admin minden jog 1,2,3,4
        [2,2],[2,3], //manager manager és workadmin 2,3
        [3,3],[4,3], //workadminok 3
        [5,4],[6,4], [7,4], //workerek 4
    ];
        foreach($roleusers as $roleuser){
              DB::table('role_user')->insert([
            'role_id' => $roleuser[1],
            'User_id' => $roleuser[0],
        ]);
        }
    }
}
