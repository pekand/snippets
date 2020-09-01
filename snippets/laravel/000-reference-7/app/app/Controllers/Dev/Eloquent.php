<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketStatus;
use App\Models\Tickets\TicketInfo;
use App\Models\Tickets\TicketComment;

class Eloquent extends Controller
{
    public function test(Request $request)
    {

        $admin = User::where('name','admin')->first();

        $newStatus = TicketStatus::where('name','new')->first();

        $ticket = Ticket::where('name','ticket name')->first();

        //insert
        if (!$ticket) {
            $ticket = new Ticket;
            $ticket->name = "ticket name";
            $ticket->assigned()->associate($admin);
            $ticket->status()->associate($newStatus);
            $ticket->save();

            $ticketInfo = new TicketInfo();
            $ticketInfo->ticket()->associate($ticket);
            $ticketInfo->save();

            $ticket->watchers()->save($admin);

            $comment = new TicketComment();
            $comment->message = "new message1 ";
            $comment->user()->associate($admin);
            $ticket->comments()->save($comment);

            $comment = new TicketComment();
            $comment->message = "new message2 ";
            $comment->user()->associate($admin);
            $ticket->comments()->save($comment);
        }

        $ticket = Ticket::find($ticket->id);

        $status = $ticket->status;
        var_dump($status->name);

        $ticketInfoId = $ticket->info->id;
        var_dump($ticketInfoId);

        $watchers  = $ticket->watchers;


        foreach ($watchers as $watcher) {
           var_dump($watcher->name);
        }

        $watching = $admin->watching;

        foreach ($watching as $ticket) {
           var_dump($ticket->name);
           var_dump($ticket->subscription->active); // access to join table column
        }

        $comments = $ticket->comments;

        foreach ($comments as $comment) {
           var_dump($comment->message);
           var_dump($comment->ticket->name);
        }

        echo "New item id:".$ticket->id."<br>";

        // get fresh model from database
        $ticket = $ticket->fresh();

        // reload model from db
        $ticket->refresh();

        // update
        $ticket->description = "new item updated";
        $ticket->save();

        // search by id
        $ticket = Ticket::find(1);

        // search by id
        $ticket = Ticket::where('id', 2)->first();

        $ticket->description = "todo description";
        $ticket->save();

        $tickets = Ticket::all();

        $tickets = Ticket::where('name', 'tiket1')->orderBy('name', 'asc')->take(10)->get();

        $tickets = Ticket::with(['status'])->get(); //Eager Loading


        Ticket::chunk(10, function ($tickets) {
            foreach ($tickets as $ticket) {
                // read by chunk
            }
        });

        // read by one, for small memory usage (one item in memory)
        foreach (Ticket::whereNull('deleted_at')->cursor() as $ticket) {
            // read with cursor
        }

        foreach ($tickets as $ticket) {
            echo $ticket->name."<br>";
        }

    }
}
