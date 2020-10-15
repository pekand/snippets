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

        $out = [];

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
        $out['ticket_id'] = $ticket->id;
        $out['ticket_name'] = $ticket->name;

        $status = $ticket->status;
        $out['ticket_status'] = $status->name;

        $ticketInfoId = $ticket->info->id;
        $out['ticket_info_id'] = $ticketInfoId;

        $watchers  = $ticket->watchers;


        $watchersOut = [];
        foreach ($watchers as $watcher) {
           $watchersOut[] = $watcher->name;
        }

        $out['ticket_watchers'] = $watchersOut;

        $watching = $admin->watching;

        $out['admin_id'] = $admin->id;

        $ticketsOut = [];
        foreach ($watching as $ticket) {
            $ticketsOut[] = [
                $ticket->name,
                $ticket->subscription->active,
            ];
        }
        $out['user_watching'] = $ticketsOut;

        $comments = $ticket->comments;

        $comentOut = [];
        foreach ($comments as $comment) {
           $comentOut[] = [
                $comment->message,
                $comment->ticket->name,
           ];
        }
        $out['ticket_comments'] = $comentOut;

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

        $ticketsOut = [];
        foreach ($tickets as $ticket) {
            $ticketsOut[] = [$ticket->name];
        }
        $out['tickets'] = $ticketsOut;

        return $out;
    }
}
