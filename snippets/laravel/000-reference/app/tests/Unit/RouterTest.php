<?php

namespace Tests\Unit;


use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Tests\TestCase;

class RouterTest extends TestCase
{

    protected function setUp(): void
    {
         parent::setUp();
         DB::statement('SET FOREIGN_KEY_CHECKS = 0');    
         Artisan::call('migrate:reset --force');
         Artisan::call('migrate --force --seed');  
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');
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

        $response = $this->json('POST', '/dev/unit/json/file', [
            'file' => $file,
        ]);

        $response->dump();

        $response->assertStatus(200);

        Storage::disk('local')->assertExists($file->hashName());

       // Storage::disk('avatars')->assertMissing('missing.jpg');
    }


    public function testCheckRouteAsUser()
    {
        $user = factory(\App\Models\Users\User::class)->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function testCheckAssertationMethods()
    {
        $response = $this->get('/dev/unit/json');
/*
        $this->assertAuthenticated($guard = null);
        $this->assertGuest($guard = null);
        $this->assertAuthenticatedAs($user, $guard = null);
        $this->assertCredentials(array $credentials, $guard = null);
        $this->assertInvalidCredentials(array $credentials, $guard = null)

        $response->assertCookie($cookieName, $value = null);
        $response->assertCookieExpired($cookieName);
        $response->assertCookieNotExpired($cookieName);
        $response->assertCookieMissing($cookieName);
        $response->assertCreated();
        $response->assertDontSee($value);
        $response->assertDontSeeText($value);
        $response->assertExactJson(array $data);
        $response->assertForbidden();
        $response->assertHeader($headerName, $value = null);
        $response->assertHeaderMissing($headerName);
        $response->assertJson(array $data, $strict = false);
        $response->assertJsonCount($count, $key = null);
        $response->assertJsonFragment(array $data);
        $response->assertJsonMissing(array $data);
        $response->assertJsonMissingExact(array $data);
        $response->assertJsonMissingValidationErrors($keys);
        $response->assertJsonPath($path, array $data, $strict = false);
        $response->assertJsonStructure(array $structure);
        $response->assertJsonValidationErrors(array $data);
        $response->assertJsonValidationErrors(array $data);
        $response->assertNoContent($status = 204);
        $response->assertNotFound();
        $response->assertOk();
        $response->assertPlainCookie($cookieName, $value = null);
        $response->assertRedirect($uri);
        $response->assertSee($value);
        $response->assertSeeInOrder(array $values);
        $response->assertSeeText($value);
        $response->assertSeeTextInOrder(array $values);
        $response->assertSessionHas($key, $value = null);
        $response->assertSessionHasInput($key, $value = null);
        $response->assertSessionHasAll(array $data);
        $response->assertSessionHasErrors(array $keys, $format = null, $errorBag = 'default');
        $response->assertSessionHasErrorsIn($errorBag, $keys = [], $format = null);
        $response->assertSessionHasNoErrors();
        $response->assertSessionDoesntHaveErrors($keys = [], $format = null, $errorBag = 'default');
        $response->assertSessionMissing($key);
        $response->assertStatus($code);
        $response->assertSuccessful();
        $response->assertUnauthorized();
        $response->assertViewHas($key, $value = null);
        $response->assertViewHasAll(array $data);
        $response->assertViewIs($value);
        $response->assertViewMissing($key);

        // phpunit assertations
        $this->assertArrayHasKey()
        $this->assertClassHasAttribute()
        $this->assertClassHasStaticAttribute()
        $this->assertContains()
        $this->assertStringContainsString()
        $this->assertStringContainsStringIgnoringCase()
        $this->assertContainsOnly()
        $this->assertContainsOnlyInstancesOf()
        $this->assertCount()
        $this->assertDirectoryExists()
        $this->assertDirectoryIsReadable()
        $this->assertDirectoryIsWritable()
        $this->assertEmpty()
        $this->assertEqualXMLStructure()
        $this->assertEquals()
        $this->assertEqualsCanonicalizing()
        $this->assertEqualsIgnoringCase()
        $this->assertEqualsWithDelta()
        $this->assertFalse()
        $this->assertFileEquals()
        $this->assertFileExists()
        $this->assertFileIsReadable()
        $this->assertFileIsWritable()
        $this->assertGreaterThan()
        $this->assertGreaterThanOrEqual()
        $this->assertInfinite()
        $this->assertInstanceOf()
        $this->assertIsArray()
        $this->assertIsBool()
        $this->assertIsCallable()
        $this->assertIsFloat()
        $this->assertIsInt()
        $this->assertIsIterable()
        $this->assertIsNumeric()
        $this->assertIsObject()
        $this->assertIsResource()
        $this->assertIsScalar()
        $this->assertIsString()
        $this->assertIsReadable()
        $this->assertIsWritable()
        $this->assertJsonFileEqualsJsonFile()
        $this->assertJsonStringEqualsJsonFile()
        $this->assertJsonStringEqualsJsonString()
        $this->assertLessThan()
        $this->assertLessThanOrEqual()
        $this->assertNan()
        $this->assertNull()
        $this->assertObjectHasAttribute()
        $this->assertRegExp()
        $this->assertStringMatchesFormat()
        $this->assertStringMatchesFormatFile()
        $this->assertSame()
        $this->assertStringEndsWith()
        $this->assertStringEqualsFile()
        $this->assertStringStartsWith()
        $this->assertThat()
        $this->assertTrue()
        $this->assertXmlFileEqualsXmlFile()
        $this->assertXmlStringEqualsXmlFile()
        $this->assertXmlStringEqualsXmlString()
*/
         $response->assertStatus(200);
    }
}
