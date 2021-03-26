@props(['disabled'=>false])
<form {{$attributes->merge(['class'=>'p-1'])}} method="post" >
    @csrf
{{--    @dump($disabled)--}}
    <x-button >like</x-button>
</form>
