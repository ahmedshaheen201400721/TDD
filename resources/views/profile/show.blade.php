<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{$user->name}}
    <div>
        created at {{$user->created_at->diffForHumans()}} ago
    </div>

    @forelse($threads as $thread)
        {{$thread->body}}
        <hr>
        <br>

    @empty
        no threads for this account
    @endforelse

</x-app-layout>
