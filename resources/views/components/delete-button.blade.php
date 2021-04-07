@props(['url','method'=>'delete'])
<x-form :method="$method" :url="$url">
    <button {{$attributes->merge(['class'=>'bg-red-400 px-4 py-2 hover:bg-red-500 rounded-lg text-white font-bold tracking-wide'])}} >
        {{$slot}}
    </button>
</x-form>
