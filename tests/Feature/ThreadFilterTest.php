<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_filter_threads_acoording_channel_slug()
    {
        $channel=Channel::factory()->create();
        $channel_thread=Thread::factory()->create(['channel_id'=>$channel->id]);
        $not_channel_thread=Thread::factory()->create();
        $response = $this->get("$channel->slug/threads");

        $response->assertSee($channel_thread->body)->assertDontSee($not_channel_thread->body);
    }

    /**
     * @test
     */
    public function a_user_can_filter_threads_according_author()
    {
        $author=User::factory()->create();
        $author_thread=Thread::factory()->create(['user_id'=>$author->id]);
        $not_author_thread=Thread::factory()->create();
        $response = $this->get("threads?filter&author=$author->name");

        $response->assertSee($author_thread->body)->assertDontSee($not_author_thread->body);
    }
    /**
     * @test
     */

    public function a_user_can_filter_threads_according_number_of_replies()
    {

        $thread2=Thread::factory()->hasReplies(2)->create();
        $thread3=Thread::factory()->hasReplies(1)->create();
        $thread1=Thread::factory()->hasReplies(5)->create();


        $response = $this->get("threads?filter&popular");

        $response->assertSeeInOrder([$thread1->name,$thread2->name,$thread3->name]);
    }


}
