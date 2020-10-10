<?php 

namespace Vendor\Package\Facades;

use Vendor\Package\Lib\Package;

class PackageFacade extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return Package::class;
    }
}
