@props(['name'])
<textarea name="{{$name}}"  rows="5" {{$attributes->merge(['class'=>"w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"])}} >
    {{old($name)}}
</textarea>
