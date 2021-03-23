<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;
use App\support\filters\QueryFilter;
use App\support\filters\ThreadFilter;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store','create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ThreadFilter $filter)
    {

        if(array_key_exists('filter', $filter->filters()) ){
            $threads= Thread::filter($filter)->paginate();

        }else{
        $threads=Thread::inRandomOrder()->paginate(10);
    }
        $threads->loadCount('replies');
        return view('threads.index',['threads'=>$threads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body'=>'required',
            'title'=>'required',
            'channel_id'=>'required|Exists:channels,id',
        ]);
        Thread::create(array_merge($request->all(),['user_id'=>auth()->id()]));
        return redirect(route('threads.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Channel $channel
     * @param \App\Models\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel,Thread $thread)
    {


        if($thread->exists){
            $thread->load(['author','replies']);
            return view('threads.show',['thread'=>$thread,'channel'=>$channel]);

        }else{
            $threads=$channel->threads()->withCount('replies')->paginate();
            return view('threads.index',['threads'=>$threads,'channel'=>$channel]);
        }

//        $replies=$thread->replies;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
