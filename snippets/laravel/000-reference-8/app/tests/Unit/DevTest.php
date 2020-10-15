<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Users\User;

class DevTest extends TestCase
{
    public function testCheckRoutes()
    {

        $user = User::factory(User::class)->create();

        $response = $this->actingAs($user)->get('/dev');
        $response->assertStatus(200);

        $response = $this->get('/dev/configuration');
        $response->assertStatus(200);

        $response = $this->get('/dev/services');
        $response->assertStatus(200);

        $response = $this->get('/dev/facades');
        $response->assertStatus(200);

        $response = $this->get('/dev/contracts');
        $response->assertStatus(200);

        $response = $this->get('/dev/session');
        $response->assertStatus(200);

        $response = $this->get('/dev/errors');
        $response->assertStatus(500);

        $response = $this->get('/dev/errors/404');
        $response->assertStatus(404);

        $response = $this->get('/dev/errors/500');
        $response->assertStatus(500);

        $response = $this->get('/dev/log');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/comment');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/variables');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/extend');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/include');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/components');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/phpblock');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/json');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/control');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/aliasing');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/collection');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/stacks');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/injection');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/extending');
        $response->assertStatus(200);

        $response = $this->get('/dev/blade/form');
        $response->assertStatus(200);

        $response = $this->get('/dev/localization/{locale}');
        $response->assertStatus(200);

        $response = $this->get('/dev/localization/{locale}/messages');
        $response->assertStatus(200);

        $response = $this->get('/dev/scaffolding/bootstrap');
        $response->assertStatus(200);

        $response = $this->get('/dev/scaffolding/vue');
        $response->assertStatus(200);

        $response = $this->get('/dev/scaffolding/react');
        $response->assertStatus(200);

        $response = $this->get('/dev/commands');
        $response->assertStatus(200);

        $response = $this->get('/dev/cache');
        $response->assertStatus(200);

        $response = $this->get('/dev/cache/locks');
        $response->assertStatus(200);

        $response = $this->get('/dev/cache/tags');
        $response->assertStatus(200);

        $response = $this->get('/dev/events');
        $response->assertStatus(200);

        $response = $this->get('/dev/file');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/files');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/create');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/operations');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/missing');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/url');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/download');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/downloadmime');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/uploadform');
        $response->assertStatus(200);

        $response = $this->get('/dev/packages');
        $response->assertStatus(200);

        $response = $this->get('/dev/helpers');
        $response->assertStatus(200);

        $response = $this->get('/dev/db/fluent');
        $response->assertStatus(200);

        $response = $this->get('/dev/db/eloquent');
        $response->assertStatus(200);

        $response = $this->get('/dev/unit/json');
        $response->assertStatus(200);

        $response = $this->get('/dev/unit/json/block');
        $response->assertStatus(200);

        $response = $this->get('/dev/unit/json/upload');
        $response->assertStatus(200);

        /*$response = $this->get('/dev/blade/form-ticket-save');
        $response->assertStatus(200);*/

        /*$response = $this->get('/dev/blade/form-ticket-comment-save');
        $response->assertStatus(200);*/

        /*$response = $this->get('/dev/file/upload');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/upload2');
        $response->assertStatus(200);

        $response = $this->get('/dev/file/upload3');
        $response->assertStatus(200);*/

        /*$response = $this->get('/dev/unit/json');
        $response->assertStatus(200);*/

        /*$response = $this->get('/dev/unit/json/block');
        $response->assertStatus(200);*/

        /*$response = $this->get('/dev/unit/json/upload');
        $response->assertStatus(200);*/

    }
}
