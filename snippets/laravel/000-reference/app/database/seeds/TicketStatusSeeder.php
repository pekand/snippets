<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statusCount = DB::table('ticket_status')->count();

        if($statusCount !== 0){
            return;
        }

        DB::table('ticket_status')->insert([
            ['name' => 'new',],
            ['name' => 'ongoing',],
            ['name' => 'done',],
        ]);
    }
}
