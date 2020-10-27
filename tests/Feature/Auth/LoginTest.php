<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
  public function testLoginpage()
  {
        $response = $this->get(route('login'));
        $response->assertSuccessful();
  }

  public function testLogin()
  {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect(route('home'));
        $response->assertTrue(Auth::check());
  }
}
