<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function when_authUser_make_thread_he_has_activity()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $thread=\App\Models\Thread::factory()->create(['user_id'=>auth()->id()]);
        $this->assertDatabaseHas('activities',[
            'user_id'=>auth()->id(),
            'type'=>'created_thread',
            'subject_id'=>$thread->id,
            'subject_type'=>"App\Models\Thread",
        ]);
    }

    /**
     * @test
     */
    public function when_authUser_make_reply_he_has_activity_for_thread_and_Reply()
    {
        $user=User::factory()->create();
        $this->actingAs($user);
        $reply=\App\Models\Reply::factory()->create(['user_id'=>auth()->id()]);
       $this->assertCount(2,Activity::all());

    }

      /**
       * @test
       */
      public function activity_has_subject()
      {
          $user=User::factory()->create();
          $this->actingAs($user);
          $thread=\App\Models\Thread::factory()->create(['user_id'=>auth()->id()]);
          $this->assertEquals($thread->id,Activity::first()->subject->id);
      }




}
