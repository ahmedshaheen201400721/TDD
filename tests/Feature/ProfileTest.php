<?php

namespace Tests\Feature;

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
    public function when_user_viist_profile_he_sees_his_threads()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $thread2 = Thread::factory()->create();
        $response = $this->get("/profile/{$user->uuid}");

        $response->assertSee($thread->body)->assertDontSee($thread2->body);

    }


}
