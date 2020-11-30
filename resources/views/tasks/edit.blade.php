@extends('layout')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
@endsection

@section('content')

    <div class="wrapper">
        <div id="page" class="container">
            <h1 class="heading has-text-weight-bold is-size-4">Update Task</h1>

            <form method="POST" action="/tasks/{{$task->id}}">
                @csrf
                @method('PUT')
                <div class="field">
                    <label class="label" for="title">Title</label>
                    <div class="control">
                        <input class="input" type="text" name="title" id="title" value="{{$task->title}}">
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="PM">Project Manager</label>
                    <div class="control">
                        <input class="input" type="text" name="PM" id="PM" value="{{$task->PM}}">
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="performer">Performer</label>
                    <div class="control">
                        <input class="input" type="text" name="performer" id="performer" value="{{$task->performer}}">
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="description">Description</label>
                    <div class="control">
                        <textarea class="textarea" name="description" id="description">{{$task->description}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="due_date">Deadline:</label>
                    <input type="date" class="form-control" placeholder="Enter deadline" id="due_date" name="due_date" value="{{$task->due_date}}">
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
