<?php

namespace Database\Seeders;

use App\Models\WareHouse;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WareHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

         $data=[
                 ['name'=>'shop', 'created_at'=>$now, 'location'=>'lahore'],
                 ['name'=>'warehouse1', 'created_at'=>$now, 'location'=>'lahore'],
                ['name'=>'warehouse2', 'created_at'=>$now, 'location'=>'lahore'],
        ];
        // DB::insert('ware_houses')->insert($data);
        WareHouse::insert($data);
    }
}
