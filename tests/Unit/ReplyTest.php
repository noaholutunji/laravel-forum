<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;
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

    /** @test */
    function it_knows_if_it_was_just_published()
    {
        $reply = create('App\Reply');

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = Carbon::now()->subMonth();

        $this->assertFalse($reply->wasJustPublished());
    }
}
