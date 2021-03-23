
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Thread') }}
        </h2>
    </x-slot>

    <form action="{{route('threads.store')}}" method="post" class="w-3/4 mx-auto">
        @csrf
        <div class="mt-3">
            <x-label value="title"></x-label>
            <x-input type="text"  name="title" class="w-full" id="title" required></x-input>
        </div>
        <x-error value="title"></x-error>


        <div class="mt-3">
            <x-label value="body"></x-label>
            <x-textarea name="body" id="body" required></x-textarea>
        </div>
        <x-error value="body"></x-error>

        <div class="mt-3">
            <select name="channel_id" class="w-full border border-blue-100" required>
                <option  disabled selected>choose your channel</option>
                @foreach(\App\Models\Channel::all() as $channel)
                <option @if(old('channel_id')==$channel->id) selected @endif value="{{$channel->id}}" >{{$channel->name}}</option>
                @endforeach
            </select>
        </div>
        <x-error value="channel_id"></x-error>



        <div class="text-center my-4">
            <x-button>submit</x-button>
{{--            <input type="submit" class="bg-green-200 px-8 py-3 rounded-xl cursor-pointer" value="submit">--}}
        </div>
    </form>
</x-app-layout>
