<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function it_has_an_owner()
    {
      $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }
}
