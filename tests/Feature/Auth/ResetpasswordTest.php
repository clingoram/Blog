<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetpasswordTest extends TestCase
{
    public function testResetpasswordpage()
    {
        $response = $this->get(route('password.reset', [
            'token' => 'fake-token'
        ]));
        $response->assertSuccessful();
    }

    public function testResetpassword()
    {
        $user = factory(User::class)->create();

        DB::table('password_resets')->insert(
            [
                'email' => $user->email,
                'token' => Hash::make('custom-token'),
                'created_at' => now()
        ]);

        $response = $this->post(route('password.update'), [
            'email' => $user->email,
            'token' => 'custom-token',
            'password' => 'new_password',
            'password_confirmation' => 'new_password'
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseMissing('password_resets', [
            'email' => $user->email,
        ]);
        $this->assertTrue(
            Hash::check('new_password', User::find($user->id)->password)
        );
    
    }
}
