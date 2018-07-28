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
            $basenap_ho = $i; $akt_ev_nap= $i+1;
            if ($basenap_ho < 10) {$basenap_ho = '0' . $basenap_ho;}
            if ($akt_ev_nap< 10) {$akt_ev_nap= '0' . $akt_ev_nap;}
        $id = DB::table('days')->insertGetId([
                'daytype_id' => 4,
                'datum' => '0000-' . $basenap_ho. '-' . $basenap_ho,
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
                'datum' => '2018-' . $basenap_ho . '-' . $akt_ev_nap,
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
