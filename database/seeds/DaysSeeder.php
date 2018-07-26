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
        for ($i = 1; $i < 13; $i++) {
            $i2 = $i; $i3= $i+1;
            if ($i2 < 10) {$i2 = '0' . $i;}
            if ($i3< 10) {$i3= '0' . $i3;}
        $id = DB::table('days')->insertGetId([
                'daytype_id' => 4,
                'datum' => '0000-' . $i . '-' . $i2,
            ]);

            DB::table('days_lang')->insert([
                'day_id' => $id,
                'lang' => 'hu',
                'name' => 'Allt. Proba Ünnep',
                'note' => 'élesben törölni!',
            ]);

            DB::table('days_lang')->insert([
                'day_id' => $id,
                'lang' => 'en',
                'name' => 'base Test holliday',
                'note' => 'Just testing!',
            ]);

        $id2 = DB::table('days')->insertGetId([
                'daytype_id' => 4,
                'datum' => '2018-' . $i . '-' . $i3,
            ]);

            DB::table('days_lang')->insert([
                'day_id' => $id2,
                'lang' => 'hu',
                'name' => '2018. Proba Ünnep',
                'note' => 'élesben törölni!',
            ]);
    
            DB::table('days_lang')->insert([
                'day_id' => $id2,
                'lang' => 'en',
                'name' => '2018 Test holliday',
                'note' => 'Just testing!',
            ]);
        }
    }
}
