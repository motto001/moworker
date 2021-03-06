<?php

use Illuminate\Database\Seeder;

class DaytypesSeeder extends Seeder
{
    /**
     * alap adatokkal tölti fel a daytypes és a daytypes_lang táblákat.
     *
     * @return void
     */
    public function run()
    {
        $daytypes = [
            [1, 'munkanap', 'workday', 1.00, 0, 1],
            [2, 'pihenőnap','restday', 2.00, 0, 0],
            [3, 'szabadnap','freeday', 2.00, 0, 0],
            [4, 'ünnepnap','hollyday', 1.00, 0, 0],
            [5, 'kiküldetés','mission', 1.00, 2000, 1],
        ];
      
        foreach ($daytypes as $daytype) {
          $id=  DB::table('daytypes')->insertGetId([
                'id' => $daytype[0],
                'szorzo' => $daytype[3],
                'fixplusz' => $daytype[4],
                'workday' => $daytype[5],
            ]);
            DB::table('daytypes_lang')->insert([
                'daytype_id' => $id,
                'lang' => 'hu',
                'name' => $daytype[1],
            ]);
            DB::table('daytypes_lang')->insert([
                'daytype_id' => $id,
                'lang' => 'en',
                'name' => $daytype[2],
            ]);
        };
    }
}
