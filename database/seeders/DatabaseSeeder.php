<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $channels=Channel::factory()->count(6)->create();
        $channels->each(fn($channel)=>\App\Models\Thread::factory()->count(6)->create(['channel_id'=>$channel->id]));
        $threads=\App\Models\Thread::all();
        $threads->each(fn($thread)=> Reply::factory()->count(array_rand(range(1,10)))->create(['thread_id'=>$thread->id,'user_id'=>$thread->author->id]));

    }
}
