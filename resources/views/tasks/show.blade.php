@extends('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2>{{$task->title}}</h2>
                    <p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
                    <p>Project Manager: {{$task->PM}}</p>
                    <p>Performer: {{$task->performer}}</p>
                    <p>Due date: {{$task->due_date}}</p>
                    <p>Time left:</p>
                    {{$task->description}}
                    <p style="margin-top: 1em">
                        @foreach($task->tags as $tag)
                            <a href="{{route('tasks.index' , ['tag' => $tag->name] ) }}">{{$tag->name}}</a>
                        @endforeach
                    </p>
                </div>

            </div>
        </div>
@endsection
