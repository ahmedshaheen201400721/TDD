<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function when_user_viist_profile_he_sees_his_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get("/profile/{$user->uuid}");

        $response->assertStatus(200)->assertSee($user->name);
    }


    /**
     * @test
     */
    public function when_user_visit_profile_he_sees_his_threads()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user);
        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $this->actingAs($user2);
        $thread2 = Thread::factory()->create(['user_id' => $user2->id]);
        $response = $this->get("/profile/{$user->uuid}");

        $response->assertSee($thread->body)->assertDontSee($thread2->body);

    }

    /**
     * @test
     */
    public function when_valid_user_delete_thread_he_delete_its_activities(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $this->delete("Threads/{$thread->slug}");
        $this->assertDatabaseMissing('Threads',['slug'=>$thread->slug]);
        $this->assertDatabaseMissing('activities',['subject_id'=>$thread->id,'subject_type'=>get_class($thread)]);

    }

    public function test_when_valid_user_delete_thread_and_its_replies_he_deletes_its_activites(){
        $user=User::factory()->create();
        $this->actingAs($user);
        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $reply=Reply::factory()->create(['user_id'=>auth()->id(),'thread_id'=>$thread->id]);
        $this->assertDatabaseCount('activities',2);

        $this->delete("Threads/{$thread->slug}");
        $this->assertDatabaseMissing('Threads',['slug'=>$thread->slug]);
        $this->assertDatabaseMissing('replies',['slug'=>$reply->body]);
        $this->assertDatabaseCount('activities',0);

    }


}
