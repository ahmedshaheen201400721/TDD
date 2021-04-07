<x-activities.activity
    name="{{$user->name}}"
    avatar="{{$user->avatar}}"
    body="{{$activity->subject->body}}"
    time="{{$activity->created_at->diffForHumans()}}"

>
        {{$user->name}} published a thread with title: <a href="{{$activity->subject->path()}}"> <span class="underline">{{$activity->subject->title}}</span> </a>
</x-activities.activity>
