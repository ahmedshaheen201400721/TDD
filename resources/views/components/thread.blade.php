<div class="py-6 w-2/3">
    <div class="flex flex-col bg-white shadow-lg rounded-lg overflow-hidden mx-auto w-11/12">
        <div class="bg-gray-200 px-6 py-4 flex justify-between">
            <div>
                <div class="uppercase text-xs text-gray-600 font-bold">Author</div>
                <a href="{{route('profile.index',$thread->author)}}">
                    <div class="flex items-center pt-3">
                        <div class="bg-blue-700 w-12 h-12 flex justify-center items-center rounded-full uppercase font-bold text-white">
                            <img src="{{$thread->author->avatar}}" alt="">

                        </div>
                        <div class="ml-4">
                            <p class="font-bold">
                                {{ $thread->author->name}}
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="text-sm">{{$thread->created_at->diffForHumans()}}</div>

        </div>

        <div class=" items-center px-6 py-4">
            <span class="text-xs "> title</span>

            <div class="bg-orange-600 font-bold uppercase px-2 py-1 rounded-full border border-gray-200 font-bold">
                <a href="{{$thread->path()}}">{{ $thread->title}}</a>
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            <div class="border rounded-lg p-4 bg-gray-200">
                {{$thread->body}}
            </div>
        </div>

        <div class="bg-gray-200 text-gray-700 text-lg px-6 py-4 flex justify-between items-center">
            @can('update',$thread)
           <div>
              <x-delete-button url="{{route('Threads.destroy',$thread)}}">delete</x-delete-button>
           </div>
            @endcan
            @php
            $count=$thread->replies_count?:$thread->replies->count();
            @endphp
          <div class="hover:text-blue-500 hover:underline"><a href="{{$thread->path()}}"> {{$count .' '.\Illuminate\Support\Str::plural('replies',$count)}}</a></div>
        </div>

    </div>
</div>

