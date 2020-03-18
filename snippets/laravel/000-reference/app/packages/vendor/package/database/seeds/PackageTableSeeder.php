<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticketsCount = DB::table('package')->count();

        if($ticketsCount !== 0){
            return;
        }

        $ticketId = DB::table('package')->insertGetId(
            ['name' => 'item1', 'created_at'=>now()],            
        );

        factory(\Vendor\Package\Models\Package::class, 5)->create()->each(function ($package) {
            $package->save();
        });

    }
}
