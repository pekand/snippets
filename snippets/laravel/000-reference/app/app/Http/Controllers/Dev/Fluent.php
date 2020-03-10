<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Fluent extends Controller
{
    public function test(Request $request)
    {
        echo "<hr><h2>select</h2>";

        // get 10 users
        $users = DB::table('users')->offset(3)->limit(3)->get();
        $users = DB::table('users')->skip(3)->take(3)->get();

        foreach ($users as $user) {
            var_dump($user->name);
        }

        echo "<hr><h2>select - one</h2>";

        // select one
        $user = DB::table('users')->select('name', 'email as user_email')->where('name', 'admin')->first();
        var_dump($user->name." ".$user->user_email);

        echo "<hr><h2>Select multiple columns</h2>";

        // select multiple columns
        $users = DB::table('users')->select('name', 'email as user_email')->where('name', 'admin')->get();
        var_dump($users[0]->name." ".$users[0]->user_email);

        echo "<hr><h2>select with parameter</h2>";

        // select user with id 1
        $user = DB::select('select * from users where id = ?', [1]);
        var_dump($user[0]->name);

        echo "<hr><h2>select one element</h2>";

        // return user with name
        $user = DB::table('users')->where('name', 'admin')->first();
        var_dump($user->name);

        // select one column
        $email = DB::table('users')->where('name', 'admin')->value('email');

        var_dump($email);

        echo "<hr><h2>select by id</h2>";

        // find by id
        $user = DB::table('users')->find(1);
        var_dump($user->name);

        echo "<hr><h2>select one column - pluck</h2>";

        // select specific column
        $emails = DB::table('users')->limit(3)->pluck('email');

        foreach ($emails as $email) {
            var_dump($email);
        }

        // select two columns
        $userInfo = DB::table('users')->limit(3)->pluck('name', 'email');

        foreach ($userInfo as $name => $email) {
            var_dump($name." ".$email);
        }

        echo "<hr><h2>where</h2>";

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

        echo "<hr><h2>select by chunk</h2>";
        // read whole big table by chunks
        DB::table('users')->orderBy('id')->chunk(3, function ($users) {
            foreach ($users as $user) {
                var_dump($user->name);
            }
            return false; // stop
        });

        echo "<hr>";

        // read whole big table by chunks (safe for update and delete items while reading)
        DB::table('users')->orderBy('id')->chunkById(3, function ($users) {
            foreach ($users as $user) {
                var_dump($user->name);
            }
            return false; // stop
        });

        echo "<hr><h2>count</h2>";

        //count items
        $usersCount = DB::table('users')->count();
        var_dump($usersCount);

        echo "<hr><h2>max</h2>";

        // max value
        $maxId = DB::table('users')->max('id');
        var_dump($maxId);

        echo "<hr><h2>avg</h2>";

        // max value
        $avgId = DB::table('users')->avg('id');
        var_dump($avgId);

        echo "<hr><h2>exists</h2>";

        // check if select return value
        $adminExist = DB::table('users')->where('name', 'admin')->exists();
        var_dump($adminExist);

        $adminNotExist = DB::table('users')->where('name', 'admin')->doesntExist();
        var_dump($adminNotExist);

        echo "<hr><h2>distinct</h2>";

        // get distinct
        $users = DB::table('users')->distinct()->get(); // get only distinct values


        echo "<hr><h2>raw selects</h2>";

        // add selection to existing query
        $query = DB::table('users')->select('name');
        $users = $query->addSelect('email')->get();

        // add custom raw sql select
        $emailCount = DB::table('users')->select(DB::raw('count(*) as user_count, email'))->groupBy('email')->get();

        // add custom raw sql select with value insert (similar whereRaw , orWhereRaw, havingRaw, orHavingRaw, orderByRaw, groupByRaw)
        $orders = DB::table('users')->selectRaw('count(*) as user_count, email, ?', ['1']) ->groupBy('email')->get();

        echo "<hr><h2>whereNull</h2>";

        // select when column is null (similar functions whereNotNull, orWhereNull, orWhereNotNull)
        $users = DB::table('users')->whereNull('name')->get();

        echo "<hr><h2>Where - Date Time</h2>";

        // where whereDate / whereMonth / whereDay / whereYear / whereTime
        $users = DB::table('users')->whereDate('created_at', '2016-12-31')->get();
        $users = DB::table('users')->whereMonth ('created_at', '12')->get();
        $users = DB::table('users')->whereDay ('created_at', '31')->get();
        $users = DB::table('users')->whereYear ('created_at', '2020')->get();
        $users = DB::table('users')->whereTime('created_at', '=', '00:00:00')->get();

        // compare columns (similar function orWhereColumn)
        $users = DB::table('users')->whereColumn('name', 'email')->get();


        echo "<hr><h2>When</h2>";

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

        echo "<hr><h2>JSON</h2>";

        // column json value {"language": "en"}
        $users = DB::table('users')->update(['options->language' => 'en']); // must by valid json minimal: "{}"
        $users = DB::table('users')->where('options->language', 'en')->get();
        $users = DB::table('users')->whereJsonContains('options->language', 'en')->get();
        $users = DB::table('users')->whereJsonLength('options->language', 0)->get(); // select where options array has empty length


        echo "<hr><h2>ORDER BY</h2>";
        $users = DB::table('users')->orderBy('name', 'desc')->get();
        $users = DB::table('users')->orderByRaw('updated_at - created_at DESC')->get();

        // select newest
        $user = DB::table('users')->latest()->first();

        // select oldest
        $user = DB::table('users')->oldest()->first();

        // select random
        $randomUser = DB::table('users')->inRandomOrder()->first();

        echo "<hr><h2>Truncate</h2>";

        //truncate
        DB::table('tickets')->truncate();
        DB::table('tickets')->delete();

        echo "<hr><h2>Insert</h2>";

        // insert
        if(DB::table('tickets')->where('id', 1)->doesntExist()) {
            DB::table('tickets')->insert([
                ['name' => 'ticket1', 'description' => 'description', 'status' => 'new', 'assigned_id' => 1, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket2', 'description' => 'description', 'status' => 'new', 'assigned_id' => 1, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket4', 'description' => 'description', 'status' => 'new', 'assigned_id' => 2, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket5', 'description' => 'description', 'status' => 'new', 'assigned_id' => 2, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket6', 'description' => 'description', 'status' => 'new', 'assigned_id' => null, 'created_at' => now(),  'updated_at' => now()],
                ['name' => 'ticket7', 'description' => 'description', 'status' => 'new', 'assigned_id' => null, 'created_at' => now(),  'updated_at' => now()],
            ]);
        }

        // insert and get id
        $id = DB::table('tickets')->insertGetId(
            ['name' => 'ticket3', 'description' => 'description', 'status' => 'new', 'assigned_id' => 1, 'created_at' => now(),  'updated_at' => now()]
        );

        var_dump($id);

        //insert if id not exists
        DB::table('tickets')->insertOrIgnore([
            ['id' => 1, 'name' => 'ticket1', 'description' => 'description', 'status' => 'new', 'assigned_id' => 1, 'created_at' => now(),  'updated_at' => now()],
            ['id' => 2, 'name' => 'ticket2', 'description' => 'description', 'status' => 'new', 'assigned_id' => 1, 'created_at' => now(),  'updated_at' => now()],
        ]);


        echo "<hr><h2>Having</h2>";

        // having
        $tickets = DB::table('tickets')->select('assigned_id', DB::raw('COUNT(*) as assigned_count'))->groupBy('assigned_id')->havingRaw('assigned_count > ?', [1])->get(); // todo
        var_dump($tickets);


        echo "<hr><h2>Delete</h2>";

        DB::table('tickets')->delete(1);// delete by id
        DB::table('tickets')->delete([1, 10]); // delete by id

        echo "<hr><h2>Increment</h2>";

        DB::table('tickets')->where('id', 2)->increment('views');
        DB::table('tickets')->where('id', 2)->increment('views', 5);
        DB::table('tickets')->where('id', 2)->decrement('views');
        DB::table('tickets')->where('id', 2)->decrement('views', 3);

        echo "<hr><h2>Join</h2>";

        // select inner join (similar to leftJoin, rightJoin)
        $tickets = DB::table('tickets')
            ->join('users', 'users.id', '=', 'tickets.assigned_id')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            echo $ticket->name." ".$ticket->user_name."<br>";
        }

        echo "<hr><h2>leftJoin</h2>";

        $tickets = DB::table('tickets')
            ->leftJoin('users', 'users.id', '=', 'tickets.assigned_id')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            echo $ticket->name." ".$ticket->user_name."<br>";
        }

        echo "<hr><h2>rightJoin</h2>";

        $tickets = DB::table('tickets')
            ->rightJoin('users', 'users.id', '=', 'tickets.assigned_id')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            echo $ticket->name." ".$ticket->user_name."<br>";
        }

        echo "<hr><h2>crossJoin</h2>";

        $tickets = DB::table('tickets') // select all from tickets amd create all combinations with users, no assign to ticket chceck
            ->crossJoin('users')
            ->select('tickets.name', 'users.name as user_name')
            ->get();

        foreach ($tickets as $ticket) {
            echo $ticket->name." ".$ticket->user_name."<br>";
        }

        echo "<hr><h2>Update</h2>";

        $affected = DB::table('tickets')
            ->where('id', 1)
            ->update(['status' => 'open', 'updated_at' => now()]);

        echo "<hr><h2>updateOrInsert</h2> ";

        DB::table('tickets')
            ->updateOrInsert(
                ['id'=>2], // match columns
                ['status' => 'close'] // new values
            );

        echo "<hr><h2>Union</h2> ";

        // union two queries together
        $first = DB::table('users')
            ->whereNull('name');

        $users = DB::table('users')
            ->whereNull('email')
            ->union($first)
            ->get();

        echo "<hr><h2>Locking</h2> ";

        DB::beginTransaction();
        DB::table('tickets')->where('id', 2)->increment('views');
        DB::table('tickets')->where('id', 2)->increment('views');
        DB::commit();

        try {
            DB::table('tickets')->where('id', 2)->sharedLock()->increment('views'); // prevent update
            DB::table('tickets')->where('id', 2)->lockForUpdate()->increment('views'); // prevent update and select
        } catch (\PDOException $e) {
            var_dump($e);
        }catch (\Illuminate\Database\QueryException $e) {
            var_dump($e);
        }catch (\Exception $e) {
            var_dump($e);
        }



        echo "<hr><h2>Debug functions</h2> ";

        //debug and halt
        //DB::table('users')->where('name', '=', 'admin')->dd();

        // view query
        DB::table('users')->where('name', '=', 'admin')->dump();


        return;
    }
}
