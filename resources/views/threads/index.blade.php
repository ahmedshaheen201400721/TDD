
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @forelse($threads as $thread)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white flex justify-between ">
                        <div>
                            <div class="p-2 font-bold border-b border-gray-200">
                                <a href="{{route('threads.show',['thread'=>$thread->slug])}}">{{ $thread->title}}</a>
                            </div>
                        </div>
                        <div>
                            {{$thread->created_at->diffForHumans()}}
                        </div>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        {{ $thread->body}}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        No Threads for you
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</x-app-layout>
