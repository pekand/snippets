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
        $status = TicketStatus::get();

        return view('tickets/pages/view', [
            'type' => 'create',
            'action' => '/tickets/ticket/insert',
            'ticket' => $ticket,
            'status' => $status,
        ]);
    }

    public function view(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        $users = User::get();

        $status = TicketStatus::get();

        return view('tickets/pages/view', [
            'type' => 'update',
            'action' => '/tickets/ticket/update/'.$ticket->id,
            'ticket' => $ticket,
            'status' => $status,
        ]);
    }

    public function insert(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'ticket_status_id' => 'required|exists:ticket_status,id',
        ]);

        if ($validator->fails()) {
            return redirect('tickets/ticket/view')
                ->withErrors($validator, 'ticket')
                ->withInput();
        }

        $ticket = new Ticket($request->all());
        $ticket->assigned()->associate(Auth::user());
        $ticket->save();

        return redirect('tickets/ticket/view/'.$ticket->id);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if($ticket === null) {
            return redirect('tickets');
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required',
            'ticket_status_id' => 'required|exists:ticket_status,id',
        ]);

        if ($validator->fails()) {
            return redirect('tickets/ticket/view/' . $ticket->id)
                ->withErrors($validator, 'ticket')
                ->withInput();
        }

        $ticket->update($request->all());
        $ticket->assigned()->associate(Auth::user());
        $ticket->save();

        return redirect('tickets/ticket/view/'.$ticket->id);
    }

    public function delete(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if($ticket === null) {
            return redirect('tickets');
        }

        $ticket->delete();

        return redirect('tickets');
    }
}
