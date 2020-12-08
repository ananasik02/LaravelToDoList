<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return view('notifications.index',[
            'notifications' => auth()->user()->notifications
        ]);
    }
}
