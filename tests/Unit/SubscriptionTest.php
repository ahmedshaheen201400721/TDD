<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_subscribe_to_thread()
    {
        $this->actingAs($user=User::factory()->create());
        $thread=Thread::factory()->create();
        $thread->subscribe($user->id);
        $this->assertSame(1,$thread->subscriptions->count());
    }

    /**
     * @test
     */
    public function user_can_unsubscribe_to_thread()
    {
        $this->actingAs($user=User::factory()->create());
        $thread=Thread::factory()->create();
        $thread->subscribe($user->id);
        $this->assertSame(1,$thread->subscriptions->count());
        $thread->unsubscribe($user->id);
        $this->assertSame(0,$thread->fresh()->subscriptions->count());

    }
}
