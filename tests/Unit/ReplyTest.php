<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_reply_owner_exist()
    {
        $reply=Reply::factory()->create();
        $this->assertInstanceOf(User::class,$reply->owner);
    }
}
