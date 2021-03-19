<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateThread_and_ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.]df
     *
     * @return void
     */
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

    public function test_authenticated_user_can_make_thread()
    {
//     Arrange we have authenticated user and thread date
       $user= User::factory()->create();
       $threadData=Thread::factory()->raw();

//      Act auth user submit thread data
        $res=$this->actingAs($user)->post('/threads',$threadData);

//      Assert seeing title.body when visiting path of this thread
        $res->assertRedirect(route('threads.index'));
        $this->get('threads')->assertSee($threadData['title'])->assertSee($threadData['body']);
    }
    public function test_guest_user_cannot_make_thread()
    {
//     Arrange we have guest user and thread date
        $threadData=Thread::factory()->raw();

//      Act guest submit thread data
        $res=$this->post('/threads',$threadData);

//      Assert redirect login
        $res->assertRedirect(route('login'));
    }
}


