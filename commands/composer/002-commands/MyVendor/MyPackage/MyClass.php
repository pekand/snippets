<?php

namespace MyVendor\MyPackage;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class MyClass
{

    public static function init()
    {
        echo "MyClass\n";
    }
    
    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        echo "Post Update Event\n";
    }

    public static function postAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

        some_function_from_an_autoloaded_file();
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        // do stuff
    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }
}
