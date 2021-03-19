<?php

namespace Database\Seeders;

use App\Models\Reply;
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
         $threads=\App\Models\Thread::factory(40)->create();
         $threads->each(fn($thread)=>Reply::factory()->count(4)->create(['thread_id'=>$thread->id,'user_id'=>$thread->user->id]));

    }
}
