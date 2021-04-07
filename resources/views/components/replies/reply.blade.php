
<div class="flex w-2/3  overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 my-3" id="reply-{{$reply->id}}">
    <div class="w-2 bg-gray-800 dark:bg-gray-900"></div>

    <div class="flex items-center px-2 py-3 justify-between w-full">
        <div>
            <div class="flex items-center">
                <img class="object-cover w-10 h-10 rounded-full" alt="User avatar" src="{{$reply->owner->avatar}}">
                <strong class="pl-2">{{$reply->owner->name}}</strong>
            </div>
           <div class="font-thin text-sm text-gray-600">{{$reply->created_at->diffForHumans()}}</div>
        </div>

        <div class="mx-3">
            <p class=""> {{ $reply->body}}</p>
        </div>

        <div>
            {{$reply->likeCount().' '.\Illuminate\Support\Str::plural('like',$reply->likeCount())}}
            <svg class="h-8 w-8 text-red-500" class="cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            @auth
                <x-like action="{{route('like',$reply)}}" disabled="{{$reply->isLiked()}}"></x-like>
            @endauth

        </div>
    </div>

</div>


{{--<div class="py-2">--}}
{{--    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--            <div class="p-6 bg-white flex justify-between ">--}}
{{--                <div>--}}
{{--                    <div> said that</div>--}}
{{--                    <div>  </div>--}}
{{--                    <div class="p-2 font-bold border-b border-gray-200"></div>--}}
{{--                </div>--}}
{{--                <div>--}}

{{--                    @auth--}}
{{--                        <x-like action="{{route('like',$reply)}}" disabled="{{$reply->isLiked()}}"></x-like>--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
