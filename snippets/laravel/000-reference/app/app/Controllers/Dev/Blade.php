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
        return view('dev/controllers/comment');
    }

    public function variables(Request $request)
    {
        return view('dev/controllers/variables', [
            'pageHeader' => 'Blade',
        ]);
    }

    public function components(Request $request)
    {
        return view('dev/controllers/components');
    }

    public function extend(Request $request)
    {
        return view('dev/controllers/extend');
    }

    public function include(Request $request)
    {
        return view('dev/controllers/include');
    }

    public function aliasing(Request $request)
    {
        return view('dev/controllers/aliasing');
    }

    public function extending(Request $request)
    {
        return view('dev/controllers/extending', [
            'time' => new \DateTime(),
        ]);
    }

    public function collection(Request $request)
    {
        $users = User::get();

        return view('dev/controllers/collection', [
            'users' => $users,
        ]);
    }

    public function stacks(Request $request)
    {
        return view('dev/controllers/stacks', []);
    }

    public function injection(Request $request)
    {
        return view('dev/controllers/injection', []);
    }

    public function phpblock(Request $request)
    {
        return view('dev/controllers/phpblock');
    }

    public function json(Request $request)
    {
        return view('dev/controllers/json', [
            'data' => [
                'param1' => 'value1',
                'param2' => 'value2'
            ]
        ]);
    }

    public function control(Request $request)
    {
        $users = User::get();

        return view('dev/controllers/control', [
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

        return view('dev/controllers/form', [
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
