<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CallistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creat a dummy Datas
        for ($i = 1; $i < 4; $i++) {
            for($a=1;$a<5; $a++){
                DB::table('callists')->insert([
                    'clid' =>  $i,
                    'level' => $a,
                    'name' => 'Name '.$a,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
