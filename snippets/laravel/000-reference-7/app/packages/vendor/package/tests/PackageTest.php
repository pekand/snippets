<?php

use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Fideloper\Proxy\TrustProxies;

class TrustedProxyTest extends TestCase
{

    public function testAction()
    {
        $package = new \Vendor\Package\Lib\Package();
        $this->assertEquals('action', $package->action());
    }
}
