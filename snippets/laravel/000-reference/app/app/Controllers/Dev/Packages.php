<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use App\Events\NewTicket;
use App\Events\ClosedTicket;
use App\Models\Tickets\Ticket;

use Vendor\Package\Facades\PackageFacade;

class Packages extends Controller
{
    public function __construct()
    {

    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function main(Request $request)
    {
       PackageFacade::action();
    }

}
