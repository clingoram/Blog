<?php

namespace Tests\Feature\Auth;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

class ForgotpasswordTest extends TestCase
{
    public function testForgotpasswordpage()
    {
        $response = $this->get(route('ssword.request'));
        $response->assertSuccessful();
    }

    public function testForgotpassword()
    {
        Notification::fake();
        $user = factory(User::class)->create();
        $response = $this->post(route('password.email'), [
            'email' => $user->email
        ]);
        $response->assertRedirect('/');
        $this->assertDatabaseHas('password_resets', [
            'email' => $user->email,
        ]);
        Notification::assertSentTo($user, ResetPassword::class);
    }
}
