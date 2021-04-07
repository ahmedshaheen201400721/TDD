<?php

namespace Tests\Feature;

use App\Models\Channel;
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

    public function test_authenticated_user_can_make_thread()
    {
//     Arrange we have authenticated user and thread date
       $user= User::factory()->create();
       $threadData=Thread::factory()->raw();
//      Act auth user submit thread data
        $res=$this->actingAs($user)->post('/Threads',$threadData);

//      Assert seeing title.body when visiting path of this thread
        $res->assertRedirect(route('Threads.index'));
        $this->get('Threads')->assertSee($threadData['title'])->assertSee($threadData['body']);
    }
    public function test_guest_user_cannot_make_thread()
    {
//     Arrange we have guest user and thread date
        $threadData=Thread::factory()->raw();

//      Act guest submit thread data
//      Assert redirect login

        $this->post('/Threads',$threadData)->assertRedirect(route('login'));
        $this->get('/Threads/create',$threadData)->assertRedirect(route('login'));
    }

    public function test_thread_require_body(){
        $threadData=Thread::factory()->make(['body'=>null]);
        $user= User::factory()->create();

        $response=$this->actingAs($user)->post('/Threads',$threadData->toArray());

        $response->assertSessionHasErrors(['body']);
    }

    public function test_thread_require_title(){
        $threadData=Thread::factory()->make(['title'=>null]);
        $user= User::factory()->create();

        $response=$this->actingAs($user)->post('/Threads',$threadData->toArray());

        $response->assertSessionHasErrors(['title']);
    }

    public function test_thread_require_valid_channel(){
        $channel=Channel::factory()->create();
        $user= User::factory()->create();
        $threadData1=Thread::factory()->make(['channel_id'=>9999]);
        $threadData2=Thread::factory()->make(['channel_id'=>null]);
        $this->actingAs($user)->post('/Threads',$threadData1->toArray())->assertSessionHasErrors(['channel_id']);
        $this->actingAs($user)->post('/Threads',$threadData2->toArray())->assertSessionHasErrors(['channel_id']);
    }
}


