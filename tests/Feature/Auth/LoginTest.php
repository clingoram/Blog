<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

//use App\User;

class LoginTest extends TestCase
{
  public function testLoginpage()
  {
      $response = $this->get(route('login'));

      // HTTP test
      // 是否有成功的狀態碼
      $response->assertSuccessful();
  }

  public function testLogin()
  {
      $user = factory(User::class)->create();

      $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
      ]);
      // 是否導回給定的 URI
      $response->assertRedirect(route('home'));

      $response->assertTrue(Auth::check());
  }
}
