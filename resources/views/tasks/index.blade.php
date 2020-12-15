@extends('layout')

@section('content')
    <div class="container">
        <form style="display: inline-block" action="/tasks/create" method="get">
            <button class= "btn btn-success">Create Task</button>
        </form>
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
                <td>{{$task->findLinks($task->PM_id)}}</td>
                <td>{{$task->findLinks($task->performer_id)}}</td>
                <td>{{$task->due_date}}</td>
                <td>{{ var_dump($task->calculateTimeLeft(900)) }}</td>
                <td style="color: #c15d2a">{{ $task->displayTimeLeft($task->id) }}</td>
                <td>
                    @if($task->completed == 1)
                        <p>Yes</p>
                    @elseif($task->completed == 0)
                        <p>No</p>
                        <form action="/tasks/{{$task->id}}/done" method="post">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" name="id" value="{{$task->id}}" />
                            <input type="submit" name="formSubmit" hidden="true" value=""/>
                        </form>
                    @endif
                </td>

           @empty
                <p>No relevant articles yet.</p>
           @endforelse
            </tbody>
        </table>
    </div>

@endsection



