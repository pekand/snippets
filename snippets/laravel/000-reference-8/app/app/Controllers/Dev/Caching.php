<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Caching extends Controller
{
    public function main(Request $request)
    {
        /* add items to cache */

        $value = cache('key');
        cache(['key' => 'value'], 10);
        cache(['key' => 'value'], now()->addMinutes(10));

        Cache::put('key1', 'value', 10); // for 10 seconds
        Cache::put('key2', 'value', now()->addMinutes(10)); // for 10 minutes
        Cache::put('key3', 'value'); // infinite

        $state = Cache::add('key4', 'value', 10); // add only if not exist, return true if is added

        Cache::forever('key5', 'value');

        Cache::put('key6', 0); // init key for incrementation
        Cache::increment('key6'); // key must exist
        Cache::increment('key6', 5);
        Cache::decrement('key6');
        Cache::decrement('key6', 3);


        cache()->remember('users', 10, function () { // cache without parameters return Illuminate\Contracts\Cache\Factory
            return DB::table('users')->get();
        });

        $users = Cache::remember('users1', 10, function () {
            return DB::table('users')->get();
        });

        $users = Cache::rememberForever('users2', function () {
            return DB::table('users')->get();
        });

        /* get items to cache */

        $key = cache('key');

        $key1 = Cache::get('key1', 'default');

        $value = Cache::store('file')->get('foo'); // use other cache driver dfined in configuration


        if (Cache::has('key1')) { // check if exist and is not null
            //
        }

        $value = Cache::pull('key1'); // get item from cache and forget

        Cache::forget('key1');

        Cache::put('key1', 'value', 0); // remove item 0 seconds
        Cache::put('key1', 'value', -5); // remove item negetive time

        //Cache::flush(); // destroy all cache

        return [
            'key1' => $key1,
        ];

    }

    public function locks(Request $request)
    {
        Cache::put('key', 0);

        $error = null;

        if(method_exists('Cache','lock')) {
            try {
                $lock = Cache::lock('lock', 10);

                if ($lock->get()) {
                    // Lock acquired for 10 seconds...

                    $lock->release();
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return [
            'key' => $key1 = Cache::get('key'),
            'error' => $error,
        ];
    }

    public function tags(Request $request)
    {
        // must by suported by cache driver
        // store items by tag
        if (!Cache::tags(['people', 'artists'])->has('user1')) { // check if exist and is not null
             Cache::tags(['people', 'artists'])->put('user1', 'tagged_value', 10);
        }

        if (!Cache::tags(['people', 'artists'])->has('user1')) { // check if exist and is not null
             Cache::tags(['people', 'artists'])->put('user1', 'tagged_value', 10);
        }

        $user1 = Cache::tags(['people', 'artists'])->get('user1');

        // remove items
        //Cache::tags(['people', 'authors'])->flush();
        //Cache::tags(['people', 'artists'])->forget('user2');
        //Cache::tags('people')->flush();

        return [
            'user1' => $user1,
        ];
    }


}
