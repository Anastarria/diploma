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

        $response->assertStatus(Response::HTTP_OK) ;

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

//invalid password
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

//incorrect email
        $response = $this->from('/login')->post('/login', [
            'email' => substr(md5(time()), 0, 6) . '@example.com',
            'password' => 'i-love-laravel',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

//email format check
        $response = $this->postJson('/login', [
            'email' => '1',
            'password' => 'i-love-laravel',
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

//password should be more than 8 symbols
        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => substr(md5(time()), 0, 6)
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->assertGuest();
    }

    public function testEditAvatar()
    {
        $user = User::factory()->make();

        Storage::fake('/');

        $response = $this->actingAs($user)->postJson('/editavatar', [
            'path_to_avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $user->path_to_avatar = 'avatar.jpg';
        $user->save();

        $response->assertRedirect('/profile/edit');
        Storage::fake('/')->assertExists('avatar.jpg');

    }

}
