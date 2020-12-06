@extends('layout')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Task</th>
                <th>PM</th>
                <th>Performer</th>
                <th>Deadline</th>
                <th>Time Left</th>
                <th>Done</th>
            </tr>
            </thead>
            <tbody>
           @forelse ($tasks as $task)
            <tr>
                <td><a href="{{ route('tasks.show', $task) }}">{{$task->title}}</a></td>
                <td>{{$task->PM_id}}</td>
                <td>{{$task->performer_id}}</td>
                <td>{{$task->due_date}}</td>
                <td style="color: #c15d2a">{{$task->calculateTimeLeft($task->id, $task->performer_id)}}</td>
                <td>{{$task->completed}}</td>

           @empty
                <p>No relevant articles yet.</p>
           @endforelse
            </tbody>
        </table>
    </div>

@endsection



