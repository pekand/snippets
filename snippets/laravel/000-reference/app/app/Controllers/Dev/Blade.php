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
        return view('dev/examples/comment');
    }

    public function variables(Request $request)
    {
        return view('dev/examples/variables', [
            'pageHeader' => 'Blade',
        ]);
    }

    public function components(Request $request)
    {
        return view('dev/examples/components');
    }

    public function section(Request $request)
    {
        return view('dev/examples/extend');
    }

    public function phpblock(Request $request)
    {
        return view('dev/examples/phpblock');
    }

    public function json(Request $request)
    {
        return view('dev/examples/json', [
            'data' => [
                'param1' => 'value1',
                'param2' => 'value2'
            ]
        ]);
    }

    public function control(Request $request)
    {
        $users = User::get();

        return view('dev/examples/control', [
            'num' => 1,
            'users' => $users,
            'records' => [
                'param1' => 'value1',
                'param2' => 'value2'
            ]
        ]);
    }

    public function form(Request $request)
    {
        $ticket = Ticket::find(1);
        $ticketComment = TicketComment::find(1);

        return view('dev/examples/form', [
            'ticket' => $ticket,
            'ticketComment' => $ticketComment,
        ]);
    }

    public function formSave(Request $request)
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

        $ticket = new Ticket($request->all());
        $ticket->assigned()->associate(Auth::user());
        $ticket->status()->associate(
            TicketStatus::where('name','new')->first()
        );
        $ticket->save();

        return redirect('dev/blade/form');
    }

    public function form2Save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dev/blade/form')
                ->withErrors($validator, 'ticket-comment')
                ->withInput();
        }

        $ticket = Ticket::where('name','ticket1')->first();
        $user = Auth::user();
        $ticket = new TicketComment($request->all());
        $ticket->user()->associate($user);
        $ticket->ticket()->associate($ticket);
        $ticket->save();

        return redirect('dev/blade/form');
    }

    
}
