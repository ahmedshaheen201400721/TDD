@props(['url','method'=>'post'])

<form action="{{$url}}" method="{{($method=='get')?'get':'post'}}" {{$attributes}}>
    @csrf
    @if(!in_array($method,['get','post']))
        @method($method)
    @endif

    {{$slot}}
</form>
