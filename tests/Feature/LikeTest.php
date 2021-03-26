<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_like_replies()
    {
        $user=User::factory()->create();

        $reply=Reply::factory()->create();
         $this->actingAs($user);
         $this->post("/replies/$reply->id/like");
        $this->assertEquals(1,$reply->likes()->count());
    }

    /**
     * @test
     */
    public function guest_cannot_like_replies()
    {
        $reply=Reply::factory()->create();
        $this->post("/replies/$reply->id/like")->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function user_can_like_replies_only_once()
    {
        $user=User::factory()->create();

        $reply=Reply::factory()->create();
        $this->actingAs($user);
        $this->post("/replies/$reply->id/like");
        $this->post("/replies/$reply->id/like");
        $this->post("/replies/$reply->id/like");
        $this->assertEquals(1,$reply->likes()->count());
    }
}
