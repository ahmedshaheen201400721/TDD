<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Subscription;
use App\Models\Thread;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Channel $channel,Thread $thread)
    {
        $thread->subscribe(auth()->id());
        return response('successful subscription',200);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel,Thread $thread)
    {
        $thread->unsubscribe(auth()->id());
        return response('successful unsubscription',200);

    }
}
