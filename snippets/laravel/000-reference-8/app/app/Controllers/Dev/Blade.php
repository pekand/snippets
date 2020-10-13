<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Users\User;
use App\Models\Tickets\Ticket;
use App\Models\Tickets\TicketStatus;
use App\Models\Tickets\TicketInfo;
use App\Models\Tickets\TicketComment;

class Blade extends Controller
{
    public function comment(Request $request)
    {
        return view('dev/controllers/blade/comment');
    }

    public function variables(Request $request)
    {
        return view('dev/controllers/blade/variables', [
            'pageHeader' => '<i>Blade</i>',
            'pageHeader2' => '<i>Blade</i>',
            'name' => 'xxx',
        ]);
    }

    public function components(Request $request)
    {
        return view('dev/controllers/blade/components');
    }

    public function extend(Request $request)
    {
        return view('dev/controllers/blade/extend');
    }

    public function include(Request $request)
    {
        return view('dev/controllers/blade/include');
    }

    public function aliasing(Request $request)
    {
        return view('dev/controllers/blade/aliasing');
    }

    public function extending(Request $request)
    {
        return view('dev/controllers/blade/extending', [
            'time' => new \DateTime(),
        ]);
    }

    public function collection(Request $request)
    {
        $users = User::get();

        return view('dev/controllers/blade/collection', [
            'users' => $users,
        ]);
    }

    public function stacks(Request $request)
    {
        return view('dev/controllers/blade/stacks', []);
    }

    public function injection(Request $request)
    {
        return view('dev/controllers/blade/injection', []);
    }

    public function phpblock(Request $request)
    {
        return view('dev/controllers/blade/phpblock');
    }

    public function json(Request $request)
    {
        return view('dev/controllers/blade/json', [
            'data' => [
                'param1' => 'value1',
                'param2' => 'value2'
            ]
        ]);
    }

    public function control(Request $request)
    {
        $users = User::get();

        return view('dev/controllers/blade/control', [
            'num' => 1,
            'users' => $users,
            'records' => [
                'param1' => 'value1',
                'param2' => 'value2'
            ]
        ]);
    }

    public function formTicket(Request $request)
    {
        $ticket = Ticket::find(1);

        return view('dev/controllers/blade/form', [
            'ticket' => $ticket,
            'ticketComment' => new TicketComment(),
        ]);
    }

    public function formTicketSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dev/blade/form')
                ->withErrors($validator, 'ticket')
                ->withInput();
        }

        $inputs = $request->all();

        if($inputs['id'] == null) {
            $ticket = new Ticket($inputs);
            $ticket->assigned()->associate(Auth::user());
            $ticket->status()->associate(
                TicketStatus::where('name','new')->first()
            );
            $ticket->save();
        } else {
            $ticket = Ticket::find($inputs['id']);
            $ticket->update($inputs);
        }

        return redirect('dev/blade/form');
    }

    public function formTicketCommentSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dev/blade/form')
                ->withErrors($validator, 'ticket-comment')
                ->withInput();
        }

        $inputs = $request->all();

        $ticketComment = null;
        if($inputs['id'] == null) {
            $ticketComment = new TicketComment($inputs);
            $ticketId = $inputs['ticket_id'];
            $ticket = Ticket::find($ticketId);
            $user = Auth::user();
            $ticketComment->user()->associate($user);
            $ticketComment->ticket()->associate($ticket);
            $ticketComment->save();
        } else {
            $ticketComment = TicketComment::find($inputs['id']);
            $ticketComment->update($inputs);
        }

        return redirect('dev/blade/form');
    }


}
