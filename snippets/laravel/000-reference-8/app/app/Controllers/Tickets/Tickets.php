<?php

namespace App\Controllers\Tickets;

use Illuminate\Http\Request;
use App\Lib\UserRepository;
use App\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketStatus;
use App\Models\Users\User;
use Illuminate\Support\Facades\Cache;

class Tickets extends Controller
{
    public function list(Request $request)
    {

        $tickets = Ticket::all();

        return view('tickets/pages/list', [
            'tickets' => $tickets
        ]);
    }

    public function create(Request $request)
    {
        $ticket = new Ticket;

        $status = Cache::remember('ticket_status', 60, function () { 
            return TicketStatus::get();
        });

        $users = Cache::remember('users', 60, function () { 
            return User::get();
        });

        return view('tickets/pages/view', [
            'type' => 'create',
            'action' => '/tickets/ticket/insert',
            'ticket' => $ticket,
            'status' => $status,
            'currentStatusId' => null,
            'currentAssignedUserId' => Auth::user()->id,
            'users' => $users,
            'currentUser' => Auth::user(),
            'watchers' => [Auth::user()->id]
        ]);
    }

    public function view(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if($ticket === null) {
            $request->session()->flash('status', 'Ticket not exist!');
            return redirect('tickets');
        }

        $status = cache()->remember('ticket_status', 60, function () { 
            return TicketStatus::get();
        });

        $users = cache()->remember('users', 60, function () { 
            return User::get();
        });

        $watchersUsers = $ticket->watchers;

        $watchers = [];
        foreach ($watchersUsers as $user) {
            $watchers[] = $user->id;
        }

        return view('tickets/pages/view', [
            'type' => 'update',
            'action' => '/tickets/ticket/update/'.$ticket->id,
            'ticket' => $ticket,
            'status' => $status,
            'currentStatusId' => $ticket->status->id,
            'currentAssignedUserId' => $ticket->assigned !== null ? $ticket->assigned->id : null,
            'users' => $users,
            'currentUser' => Auth::user(),
            'watchers' => $watchers
        ]);
    }

    public function insert(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'ticket_status_id' => 'required|exists:ticket_status,id',
            'assigned_id' => 'required|exists:users,id',
            'ticket_watchers' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect('tickets/ticket/create')
                ->withErrors($validator, 'ticket')
                ->withInput();
        }

        $ticket = new Ticket($request->all());
        $ticket->owner()->associate(Auth::user());
        $ticket->save();
        $ticket->watchers()->sync($data['ticket_watchers']);

        $request->session()->flash('status', 'Ticket was created');

        return redirect('tickets/ticket/view/'.$ticket->id);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if($ticket === null) {
            $request->session()->flash('status', 'Ticket not exist!');
            return redirect('tickets');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'ticket_status_id' => 'required|exists:ticket_status,id',
            'assigned_id' => 'required|exists:users,id',
            'ticket_watchers' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect('tickets/ticket/view/' . $ticket->id)
                ->withErrors($validator, 'ticket')
                ->withInput();
        }

        $ticket->update($request->all());
        $ticket->save();
        $ticket->watchers()->sync($data['ticket_watchers']);

        $request->session()->flash('status', 'Ticket was saved');

        return redirect('tickets/ticket/view/'.$ticket->id);
    }

    public function delete(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if($ticket === null) {
            $request->session()->flash('status', 'Ticket not exist!');
            return redirect('tickets');
        }

        $ticket->delete();

        $request->session()->flash('status', 'Ticket was deleted!');

        return redirect('tickets');
    }
}
