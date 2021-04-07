<x-activities.activity
name="{{$user->name}}"
avatar="{{$user->avatar}}"
body="{{$activity->subject->body}}"
time="{{$activity->created_at->diffForHumans()}}"
type="reply"
>
    {{$user->name}}   <strong>replied</strong> to thread  with title:
    <a href="{{$activity->subject->thread->path()}}">
        <span class="underline">{{$activity->subject->thread->title}}</span>
    </a>

</x-activities.activity>
