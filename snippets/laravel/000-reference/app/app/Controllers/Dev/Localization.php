<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Events\NewTicket;
use App\Events\ClosedTicket;
use App\Models\Tickets\Ticket;

use Vendor\Package\Facades\PackageFacade;

class Localization extends Controller
{
    public function main(Request $request, $locale)
    {
        App::setLocale($locale);

        return view('dev/examples/localization');
    }

    public function messages(Request $request, $locale)
    {
        App::setLocale($locale);

        return [
            'locale' => App::getLocale(),
            'isLocaleEn' => App::isLocale('en'),
            'welcomeMessage1' => __('app.welcome'),
            'welcomeMessage2' => __('I love programming.'), // use json files
            'welcomeMessageWithParameter1' => __('app.welcomeUser1', ['name'=>'juraj']), // use json files
            'welcomeMessageWithParameter2' => __('app.welcomeUser2', ['name'=>'juraj']), // use json files
            'welcomeMessageWithParameter3' => __('app.welcomeUser3', ['name'=>'juraj']), // use json files
            'pluralization1' => trans_choice('app.pluralization1', 5),
            'pluralization1' => trans_choice('app.pluralization2', 5),
        ];
    }

}
