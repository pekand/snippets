<?php

namespace Tests\Unit;

use Tests\TestCase;

class InfoTest extends TestCase
{
    public function testCheckRoutes()
    {
        $response = $this->get('/info');
        $response->assertStatus(200);

        $response = $this->get('/info/env');
        $response->assertStatus(200);

        $response = $this->get('/info/server');
        $response->assertStatus(200);

        $response = $this->get('/info/session');
        $response->assertStatus(200);

        $response = $this->get('/info/csfr');
        $response->assertStatus(200);

        $response = $this->get('/info/token');
        $response->assertStatus(200);

        $response = $this->get('/info/user');
        $response->assertStatus(200);

        $response = $this->get('/info/routes');
        $response->assertStatus(200);
    }
}
