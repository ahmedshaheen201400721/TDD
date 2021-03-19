<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Database\Factories\ThreadFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;
    protected $thread;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread=Thread::factory()->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_view_all_threads()
    {
        $response = $this->get('/threads');
        $response->assertStatus(200);
        $response->assertSee($this->thread->title);
    }

    public function test_user_can_view_single_thread(){
        $response=$this->get($this->thread->path());
        $response->assertSee($this->thread->title);
    }

    public function test_user_can_see_replies_when_viewing_single_thread()
    {
        $reply=Reply::factory()->create(['thread_id'=>$this->thread->id]);
        $response=$this->get($this->thread->path());
        $response->assertSee($reply->body);
    }
}
