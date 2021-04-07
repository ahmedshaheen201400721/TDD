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
        $response=$this->actingAs($user)->post("Threads/{$thread->slug}/replies",$reply->toArray());
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
        $response=$this->post("Threads/{$thread->slug}/replies",$reply->toArray());
        // assert true
        $response->assertRedirect('/login');
    }

    public function test_unauthenticated_users_can_edit_replies()
    {

        //arrange auth_user make reply to thread
        $this->actingAs($user=User::factory()->create());

        $reply=Reply::factory()->create(['user_id'=>$user->id]);

        // act login and
        $response=$this->patch(route('replies.update',$reply),['body'=>"ahmed shaheen"]);
        // assert true
        $reply=$reply->refresh();
        $this->assertSame($reply->body,"ahmed shaheen");
    }
    public function test_unauthenticated_users_can_delete_replies()
    {

        //arrange auth_user make reply to thread
        $this->actingAs($user=User::factory()->create());
        $reply=Reply::factory()->create(['user_id'=>$user->id]);

        // act login and
        $response=$this->delete(route('replies.destroy',$reply));

        // assert true
        $this->assertDatabaseMissing('replies',$reply->toArray());
    }


}
