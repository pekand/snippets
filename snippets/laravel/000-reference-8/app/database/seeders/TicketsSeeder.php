<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ticketsCount = DB::table('tickets')->count();

        if($ticketsCount !== 0){
            return;
        }

        $status = DB::table('ticket_status')->where('name', 'new')->first();        

        $admin = DB::table('users')->where('name', 'admin')->first(); 

        $ticketId = DB::table('tickets')->insertGetId(
            ['name' => 'ticket1','description'=>'todo', 'assigned_id'=>$admin->id, 'ticket_status_id'=>$status->id, 'created_at'=>now()],            
        );

        $ticketInfoId = DB::table('ticket_info')->insertGetId(
            ['ticket_id' => $ticketId, 'views'=>0, 'created_at'=>now()],            
        );

        $ticketWatcher = DB::table('ticket_watchers')->insertGetId(
            ['ticket_id' => $ticketId, 'watcher_id'=>$admin->id, 'created_at'=>now()],            
        );
    }
}
