<?php

namespace Vendor\Package\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Vendor\Package\Events\PackageEvent;

class Main extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $locale = 'en')
    {
        App::setLocale($locale);

        event(new PackageEvent("package event"));

        return view('VendorPackage::main');
    }
}
