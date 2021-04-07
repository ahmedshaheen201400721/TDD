
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

                @include('components.thread')
                @auth
                    <div class="my-4 w-1/2">
                        <form action="{{route('replies.store',$thread)}}" method="post">
                            @csrf
                            <div class=" my-4">
                                <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200">reply</label>

                                <textarea name="body" class="block h-40 px-4 w-full py-2 text-gray-700 bg-white border border-gray-300 rounded-md  focus:border-blue-100 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
                            </div>
                            <x-error value="body"></x-error>

                            <input type="submit" value="add Reply" class="px-6 py-3 bg-blue-500 text-white font-bold rounded-lg">
                        </form>
                    </div>
                @else
                    <div class="my-4">
                        <div class="text-3xl text-gray-700 ">please <a href="{{route('login')}}" class="text-blue-500 underline">sing in</a> to participate</div>
                    </div>
                @endauth

            <div class=" mx-auto sm:px-6 lg:px-8" x-data="{}">
                    <div class="text-4xl pb-4">Replies</div>
                    @forelse($thread->replies as $reply)
                        @include('components.replies.reply')

                    @empty
                        no replies
                    @endforelse
            </div>
    </div>
</div>
</x-app-layout>
