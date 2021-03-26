<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white flex justify-between ">
                <div>
                    <div class="p-2 font-bold border-b border-gray-200">
                        <a href="{{$thread->path()}}">{{ $thread->title}}</a>
                    </div>
                    <div class="p-2 font-bold border-b border-gray-200">
                        <div class="text-4xl inline"> author: </div>
                        <a href="{{route('profile.show',$thread->author)}}">{{ $thread->author->name}}</a>
                    </div>
                </div>
                <div>
                    {{$thread->created_at->diffForHumans()}}
                    {{$thread->replies_count .' '.\Illuminate\Support\Str::plural('replies',$thread->replies_count)}}
                </div>
            </div>

            <div class="p-6 bg-white border-b border-gray-200">
                {{ $thread->body}}
            </div>
            <form action="">

            </form>
        </div>
    </div>
</div>
