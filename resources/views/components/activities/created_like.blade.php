<x-activities.activity
    name="{{$user->name}}"
    avatar="{{$user->avatar}}"
    body=""
    time="{{$activity->created_at->diffForHumans()}}"
    type="reply"
>
    {{$user->name}}   <strong>liked</strong> a reply on thread  with title:
    <a href="{{$activity->subject->likeable->thread->path().'#reply-'.$activity->subject->likeable->id}}">
        <span class="underline">{{$activity->subject->likeable->title}}</span>
    </a>

</x-activities.activity>
