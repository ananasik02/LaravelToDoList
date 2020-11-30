@extends('layout')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
@endsection

@section('content')
    <div class="wrapper">
        <div id="page" class="container">
            <h1 class="heading has-text-weight-bold is-size-4">New Task</h1>

            <form method="POST" action="/tasks">
                @csrf
                <div class="field">
                    <label class="label" for="title">Title</label>
                    <div class="control">
                        <input class="input @error('title') is-danger @enderror" type="text" name="title" id="title" value="{{old('title')}}">

                        @error('title')
                            <p class="help is-danger">{{$errors->first('title')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="PM_id">Project Manager</label>
                    <div class="control">
{{--                        <input class="input @error('PM') is-danger @enderror" type="text" name="PM" id="PM" value="{{old('PM')}}">--}}
                        <select name="PM_id">
                            @foreach($pms as $pm)
                                <option value="{{$pm->id}}">{{$pm->name}}</option>
                            @endforeach
                        </select>

                        @error('PM_id')
                        <p class="help is-danger">{{$errors->first('PM')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="performer_id">Performer</label>
                    <div class="control">
{{--                        <input class="input  @error('performer') is-danger @enderror" type="text" name="performer" id="performer" value="{{old('performer')}}">--}}

                        <select name="performer_id">
                            @foreach($performers as $performer)
                                <option value="{{$performer->id}}">{{$performer->name}}</option>
                            @endforeach
                        </select>

                        @error('performer_id')
                        <p class="help is-danger">{{$errors->first('performer')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="description">Description</label>
                    <div class="control">
                        <textarea class="textarea" name="description" id="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="due_date">Deadline:</label>
                    <input type="date" class="form-control @error('due_date') is-danger @enderror" placeholder="Enter deadline"
                           id="due_date" name="due_date" value="{{old('due_date')}}">

                    @error('performer')
                    <p class="help is-danger">{{$errors->first('due_date')}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="due_date">Tags:</label>
                    <div class="control">
                        <select name="tags[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    @error('tags')
                    <p class="help is-danger">{{$message}}</p>
                    @enderror
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
