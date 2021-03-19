
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-4xl font-bold mb-2">
                    Thread
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        author: <strong>{{$thread->author->name}}</strong>
                    </div>
                    <div class="p-6 bg-white flex justify-between ">
                        <div>
                            <div class="p-2 font-bold border-b border-gray-200">{{ $thread->title}}</div>
                        </div>
                        <div>
                            {{$thread->created_at->diffForHumans()}}
                        </div>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $thread->body}}
                    </div>
                </div>
                @auth
                    <div class="my-4">
                        <div class="text-3xl text-gray-700 ">Add Reply</div>
                        <form action="{{route('replies.store',$thread)}}" method="post">
                            @csrf
                            <textarea name="body" id="" class="w-full" rows=7></textarea>
                            <input type="submit" value="add Comment" class="px-6 py-3 bg-blue-500 text-white font-bold rounded-lg">
                        </form>
                    </div>
                @else
                    <div class="my-4">
                        <div class="text-3xl text-gray-700 ">please <a href="{{route('login')}}" class="text-blue-500 underline">sing in</a> to participate</div>
                    </div>
                @endauth
            </div>
        </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-4xl pb-4">Replies</div>

            @forelse($thread->replies as $reply)
                <div class="py-2">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white flex justify-between ">
                                <div>
                                    <div> <strong>{{$reply->owner->name}}</strong>said that</div>
                                    <div class="p-2 font-bold border-b border-gray-200">{{ $reply->body}}</div>
                                </div>
                                <div>
                                    {{$reply->created_at->diffForHumans()}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                no replies
            @endforelse
        </div>

</x-app-layout>
