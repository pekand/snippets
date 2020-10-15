<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fluent extends Controller
{
    public function test(Request $request)
    {

        $out = '';

        $out .= "<h1>Fluent db interface</h1>";

        $out .= "<hr><h2>select</h2>";

        // get 10 users
        $users = DB::table('users')->offset(3)->limit(3)->get();
        $users = DB::table('users')->skip(3)->take(3)->get();

        foreach ($users as $user) {
            $out .= print_r($user->name, true);
        }

        $out .= "<hr><h2>select - one</h2>";

        // select one
        $user = DB::table('users')->select('name', 'email as user_email')->where('name', 'admin')->first();
        $out .= print_r($user->name." ".$user->user_email, true);

        $out .= "<hr><h2>Select multiple columns</h2>";

        // select multiple columns
        $users = DB::table('users')->select('name', 'email as user_email')->where('name', 'admin')->get();
        $out .= print_r($users[0]->name." ".$users[0]->user_email, true);

        $out .= "<hr><h2>select with parameter</h2>";

        // select user with id 1
        $user = DB::select('select * from users where id = ?', [1]);
        $out .= print_r($user[0]->name, true);

        $out .= "<hr><h2>select one element</h2>";

        // return user with name
        $user = DB::table('users')->where('name', 'admin')->first();
        $out .= print_r($user->name, true);

        // select one column
        $email = DB::table('users')->where('name', 'admin')->value('email');

        $out .= print_r($email, true);

        $out .= "<hr><h2>select by id</h2>";

        // find by id
        $user = DB::table('users')->find(1);
        $out .= print_r($user->name, true);

        $out .= "<hr><h2>select one column - pluck</h2>";

        // select specific column
        $emails = DB::table('users')->limit(3)->pluck('email');

        foreach ($emails as $email) {
            $out .= print_r($email, true);
        }

        // select two columns
        $userInfo = DB::table('users')->limit(3)->pluck('name', 'email');

        foreach ($userInfo as $name => $email) {
            $out .= print_r($name." ".$email, true);
        }

        $out .= "<hr><h2>where</h2>";

        // where with condition
        $users = DB::table('users')->where('id', '>', 10)->get();

        // select value between (similar to orWhereBetween, whereNotBetween, orWhereNotBetween)
        $users = DB::table('users')->whereBetween('id', [1, 100])->get();

        // in set (similar functiona whereNotIn,  orWhereIn, orWhereNotIn)
        $users = DB::table('users')->whereIn('id', [1, 2, 3])->get();

        // multiple where
        $users = DB::table('users')->where([['id', 'like', 'a%'], ['id', '>', 10]])->get();
        $users = DB::table('users')->where('id', 1)->orWhere('id', '2')->orWhere(function($query) {
            $query->where('name', 'admin')->orWhere('id', 2); // or grouping
        })->get();

        // where with equal condition
        $users = DB::table('users')->where('name', 'admin')->get();

        $out .= "<hr><h2>select by chunk</h2>";
        // read whole big table by chunks
        DB::table('users')->orderBy('id')->chunk(3, function ($users) use (&$out) {
            foreach ($users as $user) {
                $out .= print_r($user->name, true);
            }
            return false; // stop
        });

        $out .= "<hr>";

        // read whole big table by chunks (safe for update and delete items while reading)
        DB::table('users')->orderBy('id')->chunkById(3, function ($users) use (&$out) {
            foreach ($users as $user) {
                 $out .= print_r($user->name, true);
            }
            return false; // stop
        });

        $out .= "<hr><h2>count</h2>";

        //count items
        $usersCount = DB::table('users')->count();
        $out .= print_r($usersCount, true);

        $out .= "<hr><h2>max</h2>";

        // max value
        $maxId = DB::table('users')->max('id');
        $out .= print_r($maxId, true);

        $out .= "<hr><h2>avg</h2>";

        // max value
        $avgId = DB::table('users')->avg('id');
        $out .= print_r($avgId, true);

        $out .= "<hr><h2>exists</h2>";

        // check if select return value
        $adminExist = DB::table('users')->where('name', 'admin')->exists();
        $out .= print_r($adminExist, true);

        $adminNotExist = DB::table('users')->where('name', 'admin')->doesntExist();
        $out .= print_r($adminNotExist, true);

        $out .= "<hr><h2>distinct</h2>";

        // get distinct
        $users = DB::table('users')->distinct()->get(); // get only distinct values


        $out .= "<hr><h2>raw selects</h2>";

        // add selection to existing query
        $query = DB::table('users')->select('name');
        $users = $query->addSelect('email')->get();

        // add custom raw sql select
        $emailCount = DB::table('users')->select(DB::raw('count(*) as user_count, email'))->groupBy('email')->get();

        // add custom raw sql select with value insert (similar whereRaw , orWhereRaw, havingRaw, orHavingRaw, orderByRaw, groupByRaw)
        $orders = DB::table('users')->selectRaw('count(*) as user_count, email, ?', ['1']) ->groupBy('email')->get();

        $out .= "<hr><h2>whereNull</h2>";

        // select when column is null (similar functions whereNotNull, orWhereNull, orWhereNotNull)
        $users = DB::table('users')->whereNull('name')->get();

        $out .= "<hr><h2>Where - Date Time</h2>";

        // where whereDate / whereMonth / whereDay / whereYear / whereTime
        $users = DB::table('users')->whereDate('created_at', '2016-12-31')->get();
        $users = DB::table('users')->whereMonth ('created_at', '12')->get();
        $users = DB::table('users')->whereDay ('created_at', '31')->get();
        $users = DB::table('users')->whereYear ('created_at', '2020')->get();
        $users = DB::table('users')->whereTime('created_at', '=', '00:00:00')->get();

        // compare columns (similar function orWhereColumn)
        $users = DB::table('users')->whereColumn('name', 'email')->get();


        $out .= "<hr><h2>When</h2>";

        // add where only when condition is true
        $sortBy = "id";
        $users = DB::table('users')
            ->when($sortBy, function ($query, $sortBy) {
                return $query->orderBy($sortBy);
            }, function ($query) { // if false (optional part)
                return $query->orderBy('name');
            })
            ->get();


        // get tickets where user exists
        $users = DB::table('tickets')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1)) // if this query is not empty
                    ->from('users')
                    ->whereRaw('tickets.assigned_id = users.id');
            })
            ->get();

        $out .= "<hr><h2>JSON</h2>";

        // column json value {"language": "en"}
        $users = DB::table('users')->update(['options->language' => 'en']); // must by valid json minimal: "{}"
        $users = DB::table('users')->where('options->language', 'en')->get();
        $users = DB::table('users')->whereJsonContains('options->language', 'en')->get();
        $users = DB::table('users')->whereJsonLength('options->language', 0)->get(); // select where options array has empty length


        $out .= "<hr><h2>ORDER BY</h2>";
        $users = DB::table('users')->orderBy('name', 'desc')->get();
        $users = DB::table('users')->orderByRaw('updated_at - created_at DESC')->get();

        // select newest
        $user = DB::table('users')->latest()->first();

        // select oldest
        $user = DB::table('users')->oldest()->first();

        // select random
        $randomUser = DB::table('users')->inRandomOrder()->first();

        $out .= "<hr><h2>Truncate</h2>";

        //truncate

        DB::beginTransaction();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('ticket_watchers')->truncate();
        DB::table('ticket_info')->truncate();
        DB::table('ticket_comments')->truncate();
        DB::table('tickets')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::commit();

        DB::table('tickets')->delete();

        $out .= "<hr><h2>Insert</h2>";

        // insert
        if(DB::table('tickets')->where('id', 1)->doesntExist()) {
            DB::table('tickets')->insert([
                ['name' => 'ticket1', 'description' => 'description', 'owner_id' => 1, 'assigned_id' => 1,    'ticket_status_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket2', 'description' => 'description', 'owner_id' => 1, 'assigned_id' => 1,    'ticket_status_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket4', 'description' => 'description', 'owner_id' => 1, 'assigned_id' => 2,    'ticket_status_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket5', 'description' => 'description', 'owner_id' => 1, 'assigned_id' => 2,    'ticket_status_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket6', 'description' => 'description', 'owner_id' => 1, 'assigned_id' => null, 'ticket_status_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket7', 'description' => 'description', 'owner_id' => 1, 'assigned_id' => null, 'ticket_status_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
            ]);
        }

        // insert and get id
        $id = DB::table('tickets')->insertGetId(
            ['name' => 'ticket3', 'description' => 'description', 'ticket_status_id' => 1, 'assigned_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()]
        );

        $out .= print_r($id, true);

        //insert if id not exists
        DB::table('tickets')->insertOrIgnore([
            ['id' => 1, 'name' => 'ticket1', 'description' => 'description', 'ticket_status_id' => 1, 'assigned_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
            ['id' => 2, 'name' => 'ticket2', 'description' => 'description', 'ticket_status_id' => 1, 'assigned_id' => 1, 'deleted_at' => null, 'created_at' => now(),  'updated_at' => now()],
        ]);


        $out .= "<hr><h2>Having</h2>";

        // having
        $tickets = DB::table('tickets')->select('assigned_id', DB::raw('COUNT(*) as assigned_count'))->groupBy('assigned_id')->havingRaw('assigned_count > ?', [1])->get();
        $out .= print_r($tickets, true);


        $out .= "<hr><h2>Delete</h2>";

        DB::table('tickets')->delete(1);// delete by id
        DB::table('tickets')->delete([1, 10]); // delete by id

        $out .= "<hr><h2>Increment</h2>";

        DB::table('tickets')->where('id', 2)->increment('view_counter');
        DB::table('tickets')->where('id', 2)->increment('view_counter', 5);
        DB::table('tickets')->where('id', 2)->decrement('view_counter');
        DB::table('tickets')->where('id', 2)->decrement('view_counter', 3);

        $out .= "<hr><h2>Join</h2>";

        // select inner join (similar to leftJoin, rightJoin)
        $tickets = DB::table('tickets')
            ->join('users', 'users.id', '=', 'tickets.assigned_id')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            $out .= $ticket->name." ".$ticket->user_name."<br>";
        }

        $out .= "<hr><h2>leftJoin</h2>";

        $tickets = DB::table('tickets')
            ->leftJoin('users', 'users.id', '=', 'tickets.assigned_id')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            $out .= $ticket->name." ".$ticket->user_name."<br>";
        }

        $out .= "<hr><h2>rightJoin</h2>";

        $tickets = DB::table('tickets')
            ->rightJoin('users', 'users.id', '=', 'tickets.assigned_id')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            $out .= $ticket->name." ".$ticket->user_name."<br>";
        }

        $out .= "<hr><h2>crossJoin</h2>";

        $tickets = DB::table('tickets') // select all from tickets amd create all combinations with users, no assign to ticket chceck
            ->crossJoin('users')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            $out .= $ticket->name." ".$ticket->user_name."<br>";
        }

        $out .= "<hr><h2>Update</h2>";

        $affected = DB::table('tickets')
            ->where('id', 1)
            ->update(['ticket_status_id' => 2, 'updated_at' => now()]);

        $out .= "<hr><h2>updateOrInsert</h2> ";

        DB::table('tickets')
            ->updateOrInsert(
                ['id'=>2], // match columns
                ['ticket_status_id' => 3] // new values
            );

        $out .= "<hr><h2>Union</h2> ";

        // union two queries together
        $first = DB::table('users')
            ->whereNull('name');

        $users = DB::table('users')
            ->whereNull('email')
            ->union($first)
            ->get();

        $out .= "<hr><h2>Locking</h2> ";

        DB::beginTransaction();
        DB::table('tickets')->where('id', 2)->increment('view_counter');
        DB::table('tickets')->where('id', 2)->increment('view_counter');
        DB::commit();

        try {
            DB::table('tickets')->where('id', 2)->sharedLock()->increment('view_counter'); // prevent update
            DB::table('tickets')->where('id', 2)->lockForUpdate()->increment('view_counter'); // prevent update and select
        } catch (\PDOException $e) {
            $out .= print_r($e, true);
        }catch (\Illuminate\Database\QueryException $e) {
            $out .= print_r($e, true);
        }catch (\Exception $e) {
            $out .= print_r($e, true);
        }

        $out .= "<hr><h2>Debug functions</h2> ";

        //debug and halt
        //DB::table('users')->where('name', '=', 'admin')->dd();

        // view query
        //DB::table('users')->where('name', '=', 'admin')->dump();

        return $out;
    }
}
