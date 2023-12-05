@extends('layouts.app')

@section('title' ,$task-> title)

@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.index') }}"
           class="link">Go Back To The Task List !</a>
    </nav>
<p class = "mb-4 text-slate-700">Description : {{ $task->description }}</p>

@if($task->long_description)
    <p class = "mb-4 text-slate-700" >Long Description : {{ $task->long_description }}</p>
@endif

<p class="mb-4 text-sm text-slate-500"> Created At :- {{ $task->created_at->diffForHumans() }}</p>
<p class="mb-4 text-sm text-slate-500"> Updated At :- {{ $task->updated_at->diffForHumans() }}</p>

<p class="mb-4 ">
@if($task->completed)
        <span class="font-medium text-green-500">Compeleted</span>
    @else
        <span class="font-medium text-red-500">Not Compeleted</span>
@endif
</p>

<div class="flex gap-3">
    <a href="{{ route('tasks.edit'  , ['task' => $task]) }}  "
       class="btn">Edit</a>

    <form method="POST" action="{{route('tasks.toggle-complete' , ['task' =>$task])}}">
        @csrf
        @method('PUT')
        <button type="submit"
                class="btn">
            Mark As {{ $task->completed ? 'not completed' : 'completed' }}
        </button>
    </form>

{{--    #لارفيل ذكيه لدرجه ان هنا لو باصيت ال id او مباصتهوش هيا عارفه انك تقصد انهي id--}}
    <form action="{{ route('tasks.destroy' , ['task' =>$task]) }}" method="post">
        @csrf
        @method('DELETE')
        <button  type="submit"
                 class="btn">Delete</button>
    </form>
</div>
@endsection

