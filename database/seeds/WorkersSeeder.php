<?php

use Illuminate\Database\Seeder;

class WorkersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workers = [
            [5,'worker'],
            [6,'worker2'],    
        ];
        foreach ($workers as $worker) {
            DB::table('workers')->insert([
                'user_id' => $worker[0],
                'fullname' => $worker[1],          
            ]);
        }
        ;
    }
}
