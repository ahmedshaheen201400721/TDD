<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function auth_user_can_subscribe_to_thread()
    {
        $this->actingAs($user=User::factory()->create());
        $thread=Thread::factory()->create();
        $response = $this->post($thread->path().'/subscribe');
        $this->assertSame(1,$thread->subscriptions->count());
        $this->assertTrue($thread->isSubscribed);

    }


    /**
     * @test
     */
    public function auth_user_can_unsubscribe_to_thread()
    {
        $this->actingAs($user=User::factory()->create());
        $thread=Thread::factory()->create();
        $response = $this->post($thread->path().'/subscribe');
        $this->assertSame(1,$thread->subscriptions->count());
        $response = $this->delete($thread->path().'/subscribe');
        $thread->unsubscribe(auth()->id());
        $this->assertSame(0,$thread->fresh()->subscriptions->count());

    }
}
