<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessfulRegistration()
    {
        $user = User::factory()->make();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $users = User::query()->get();
        foreach ($users as $used){
            $this->assertNotSame($user, $used);
        }

        $response->assertStatus(Response::HTTP_CREATED);

    }

    public function testLoginFormAvailable()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('Auth.login');
    }

    public function testUserLoginSuccessful()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function testUserLoginFailed()
    {
        $user = User::factory()->create([
            'password' => bcrypt('i-love-laravel'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertGuest();
    }

//    public function test_avatars_can_be_uploaded()
//    {
//        User::factory()->make();
//
//        $file = UploadedFile::fake()->image('avatar.jpg');
//
//        Storage::fake('public/avatars');
//
//        $this->actingAs($this->user)->post('/editavatar', [
//            'path_to_avatar' => $file,
//        ]);
//
//
//        Storage::fake('public/avatars')->assertExists($file->hashName());
//        Storage::fake('public/avatars')->assertMissing('missing.jpg');
//    }

}
