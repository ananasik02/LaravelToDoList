@extends('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <form style="display: inline-block" action="/tasks/{{$task->id}}/edit" method="get">
                    <button class= "btn btn-success">Update Task</button>
                </form>
                <form style="display: inline-block" action="/tasks/{{$task->id}}/delete" method="get">
                    <input hidden="true" name="id" value="{{$task->id}}">
                    <button class= "btn btn-danger">Delete Task</button>
                </form>
                <div class="title">
                    <h2>{{$task->title}}</h2>
                    <p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
                    <p>{{$task->description}}</p>
                    <p>Project Manager: {{$task->findLinks($task->PM_id)}}</p>
                    <p>Performer: {{$task->findLinks($task->performer_id)}}</p>
                    <p>Due date: {{$task->due_date}}</p>
                    <p>Time left: {{var_dump($task->calculateTimeLeft($task->id, $task->performer_id))}} </p>
                    <p style="margin-top: 1em">
                        @foreach($task->tags as $tag)
                            <a href="{{route('tasks.index' , ['tag' => $tag->name] ) }}">{{$tag->name}}</a>
                        @endforeach
                    </p>
                </div>

            </div>
        </div>
@endsection
