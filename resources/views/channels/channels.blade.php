
@foreach(\Illuminate\Support\Facades\Cache::rememberForever('channels',fn()=>\App\Models\Channel::all() ) as $channel)
    <x-dropdown-link :href="$url=route('Threads.show',['channel'=> $channel->slug])">
        {{$channel->name}}
    </x-dropdown-link>
@endforeach
