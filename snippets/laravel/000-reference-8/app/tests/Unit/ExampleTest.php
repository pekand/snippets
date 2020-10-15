<?php

namespace Tests\Unit;


use App\Models\Users\User;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setUp(): void
    {
         parent::setUp();
         /*DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         Artisan::call('migrate:reset --force');
         Artisan::call('migrate --force --seed');
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');*/
    }

    public function testCheckIfAdminExists()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'admin@admin',
        ]);
    }

    public function testCheckRouteStatus()
    {
        //App::environment(); //testing

        $response = $this->get('/dev/unit/json');

        //$response->dumpHeaders();
        //$response->dumpSession();
        //$response->dump();

        $response->assertStatus(200);
    }

    public function testCheckRouteWithCookie()
    {
        $response = $this->withCookie('cookiname', 'cookievalue')->get('/dev/unit/json');

        $response->assertStatus(200);

        $response = $this->withCookies([
            'cookiname1' => 'cookievalue',
            'cookiname2' => 'cookievalue',
        ])->get('/dev/unit/json');

        $response->assertStatus(200);
    }

    public function testCheckRouteWithSession()
    {
        $response = $this->withSession([
            'name1' => 'value',
            'name2' => 'value',
        ])->get('/dev/unit/json');

        $response->assertStatus(200);
    }

    public function testCheckRouteWithHeader()
    {
        $response = $this->withHeaders([
            'customheader' => 'customValue',
        ])->get('/dev/unit/json');

        $response->assertStatus(200);
    }

    public function testCheckRouteJson()
    {
        // json with action type
        $response = $this->json('POST', '/dev/unit/json/block', [
                'name' => 'value'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => ['code'=>1],
            ]);


        // partial json respone
        $response = $this->postJson('/dev/unit/json/block', [
                'name' => 'value'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => true,
            ]);

        // exact json respone
        $response = $this->postJson('/dev/unit/json/block', [
                'name' => 'value'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'status' => [
                    'code' => '1',
                    'message' => 'ok',
                ],
            ]);

        // json path - match value
        $response = $this->postJson('/dev/unit/json/block', [
                'name' => 'value'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJsonPath('status.code', '1');
    }

    public function testCheckFileUpload()
    {
        Storage::fake('avatars');

        $avatar = UploadedFile::fake()->image('avatar.jpg');
        $avatar = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(100);
        $file = UploadedFile::fake()->create('document.pdf', 1024, 'application/pdf'); // size in kilobytes and mime type

        $response = $this->json('POST', '/dev/unit/json/upload', [
            'file' => $file,
        ]);

        //$response->dump(); // get debug informations

        $response->assertStatus(200);

        Storage::disk('documents')->assertExists($file->hashName());

        if(Storage::disk('documents')->exists($file->hashName())) {
            Storage::disk('documents')->delete($file->hashName());
        }

       // Storage::disk('avatars')->assertMissing('missing.jpg');
    }


    public function testCheckRouteAsUser()
    {
        $user = \App\Models\Users\User::factory(\App\Models\Users\User::class)->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function testCheckAssertationMethods()
    {
        $response = $this->get('/dev/unit/json');

        $response->assertStatus(200);
    }
}
