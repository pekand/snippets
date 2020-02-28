<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Eloquent extends Controller
{
    public function test(Request $request)
    {

        $item = \App\Models\Test3::find(1);

        //insert
        if (!$item) {
            $item = new \App\Models\Test3;
            $item->name = "new item";
            $item->status = "new";
            $item->save();
        }

        echo "New item id:".$item->id."<br>";

        // get fresh model from database
        $item = $item->fresh();

        // reload model from db
        $item->refresh();

        // update
        $item->name = "new item updated";
        $item->status = "updated";
        $item->save();

        // search by id
        $item = \App\Models\Test3::find(1);

        // search by id
        $item = \App\Models\Test3::where('id', 1)->first();


        $item->name = "first item updated";
        $item->status = "updated";
        $item->save();

        $items = \App\Models\Test3::all();

        $items = \App\Models\Test3::where('status', 'updated')->orderBy('name', 'asc')->take(10)->get();

        \App\Models\Test3::chunk(10, function ($items) {
            foreach ($items as $item) {
                // read by chunk
            }
        });

        // read by one, for small memory usage (one item in memory)
        foreach (\App\Models\Test3::where('status', 'updated')->cursor() as $item) {
            // read with cursor
        }

        foreach ($items as $item) {
            echo $item->name."<br>";
        }

    }
}
