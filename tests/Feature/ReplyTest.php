<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_can_make_replies()
    {
        //arrange auth_user make reply to thread
        $user=User::factory()->create();
        $thread=Thread::factory()->create();
        $reply=Reply::factory()->make(['thread_id'=>$thread->id]);

        // act login and make reply
        $response=$this->actingAs($user)->post("threads/{$thread->slug}/replies",$reply->toArray());
//         assert status/redirect/see reply
        $response->assertStatus(201);
        $response->assertRedirect($thread->path());
        $this->get($thread->path())->assertSee($reply->body);
    }

    public function test_unauthenticated_users_cannot_make_replies()
    {

        //arrange auth_user make reply to thread
        $thread=Thread::factory()->create();
        $reply=Reply::factory()->make(['thread_id'=>$thread->id]);

        // act login and
        $response=$this->post("threads/{$thread->slug}/replies",$reply->toArray());
        // assert true
        $response->assertRedirect('/login');
    }

}
