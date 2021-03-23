@props(['value'])
@error($value)
    <div class="bg-red-200 text-red-600 font-bold px-8 pb-3 mt-1">
        <ul>
            @foreach($errors->get($value) as $error)
                {{$error}}
            @endforeach
        </ul>
    </div>
@enderror
