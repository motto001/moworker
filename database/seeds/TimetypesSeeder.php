<?php

use Illuminate\Database\Seeder;

class TimetypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timetypes = [
            [1, 'normal', 'normaly', 1.00],
            [2, 'délutáni','afternon', 1.50],
            [3, 'túlóra','extrahour', 2.00],
            [4, 'szünet','braktime', 0.00],
        ];
      
        foreach ($timetypes as $timetype) {
            DB::table('timetypes')->insert([
                'id' => $timetype[0],
                'szorzo' => $timetype[3],
            ]);
            DB::table('timetypes_lang')->insert([
                'timetype_id' => $timetype[0],
                'lang' => 'hu',
                'name' => $timetype[1],
            ]);
            DB::table('timetypes_lang')->insert([
                'timetype_id' => $timetype[0],
                'lang' => 'en',
                'name' => $timetype[2],
            ]);
        };
    }
}
