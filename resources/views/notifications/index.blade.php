
@extends('layout')

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <ul>
                @foreach($notifications as $notification)
                    <li>
                        @if($notification->type === 'App\Notifications\TaskAssigned')
                            You have a new task assigned id{{$notification->data['taskId'] }}  {{$notification->data['taskName']}}
                         @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
