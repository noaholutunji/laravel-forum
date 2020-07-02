<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration()
    {
        Mail::fake();

        $this->post(route('register'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar19',
            'password_confirmation' => 'foobar19'
        ]);

        Mail::assertQueued(PleaseConfirmYourEmail::class);
    }

    /** @test */
    function user_can_fully_confirm_their_email_addresses()
    {
        Mail::fake();

        $this->post(route('register'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'foobar19',
            'password_confirmation' => 'foobar19'
        ]);

        $user = User::whereName('John')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

       $this->get(route('register.confirm', ['token' => $user->confirmation_token]))
            ->assertredirect(route('threads'));

        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->fresh()->confirmed);
            $this->assertNull($user->fresh()->confirmation_token);
        });
    }

    /** @test */
    function confirming_an_invalid_token()
    {
       $this->get(route('register.confirm', ['token' => 'invalid'] ))
            ->assertRedirect(route('threads'))
            ->assertSessionHas('flash', 'Unknown token.');
    }
}
