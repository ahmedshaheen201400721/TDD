
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="w-3/4 mx-auto pt-4">
        {{$threads->links()}}
    </div>
    @forelse($threads as $thread)
     @include('components.thread')
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
