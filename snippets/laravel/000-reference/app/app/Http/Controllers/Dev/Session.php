<?php

namespace App\Http\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Session extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request)
    {
        /* store value */
        $request->session()->put('key', 'value');

        session(['key' => 'value']);

        session(['items' => ['item1', 'item2']]); // store array

        session(['items.item' => 'item3']); // add item to array

        /* get value */
        $value = $request->session()->get('key', 'default');

        $value = $request->session()->get('key', function () {
            return 'default';
        });

        $value = session('key');

        $value = session('key', 'default');

        $data = $request->session()->all();

        session(['key2' => 'value']);
        $key2 = $request->session()->pull('key2', 'default'); // get and delete value in one step

        $request->session()->flash('status', 'Task was successful!'); // one time flash message, deleted by next request 
        $request->session()->reflash(); // show flash messages second time
        $request->session()->keep(['status']); // show specific flash messages second time

        /* test key in session */
        if ($request->session()->has('key')) { // key exists and not null
            //
        }

        if ($request->session()->exists('key')) { // key exsist (can be null)
            //
        }

        /* delete value */

        $request->session()->forget('key');// remove key

        // Forget multiple keys...
        $request->session()->forget(['key1', 'key2']); // remove specific keys

        //$request->session()->flush(); // remove all (user is 'logouted')
      

        return [
            'laravel_session'=>\Illuminate\Support\Facades\Session::getId(),
            'all' => $data,
            'key' => $value,
            'items' => session('items'),
        ];
    }
}
