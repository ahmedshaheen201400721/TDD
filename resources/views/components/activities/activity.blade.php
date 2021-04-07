@props(['avatar','name','time','body'])
<div class="max-w-2xl px-8 py-4  my-8 mx-auto bg-white rounded-lg shadow-md bg-blue-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <img class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block" src="{{$avatar}}" alt="avatar">
            <a class="font-bold text-gray-700 cursor-pointer dark:text-gray-200">{{$name}}</a>
        </div>
        <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{$time}}</span>
    </div>

    <div class="mt-2">
        <p class="text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200 ">{{$slot}}</p>
        <p class="mt-2 text-gray-600 dark:text-gray-300">{{$body}}</p>
    </div>

</div>
