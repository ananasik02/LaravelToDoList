@extends('layout')
@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <div id="content">
                <div class="title">
                    <h2>Welcome to our website</h2>
                    <span class="byline">Developed by Matsonka02</span> </div>
                <p><img src="images/banner.jpg" alt="" class="image image-full" /> </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                Hi, {{\Illuminate\Support\Facades\Auth::user()->name}}
                            @else
                                You need to log in
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="copyright" class="container">
            <p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
        </div>
@endsection
