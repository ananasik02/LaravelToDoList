<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\TaskAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class TasksController extends Controller
{
    public function index()
    {
        if(request('tag')){
            $tasks = Tag::where('name', request('tag'))->firstOrFail()->tasks;
        }else {
            $tasks = Task::latest()->get();
        }
        return view('tasks.index',['tasks' => $tasks]);
    }

    public function show(Task $task)
    {
        return view('tasks.show',['task' => $task]);
    }

    public function create()
    {
        return view('tasks.create' , [
            'tags' => Tag::all(),
            'pms' => User::all(),
            'performers' => User::all()
        ]);
    }

    public function store()
    {

        $task = new Task($this->validateTask());
        $task->user_id = 1;
        $task->save();
        $task->tags()->attach(request('tags'));
        User::find(request()->performer_id)->notify(new TaskAssigned($task->id));
        return redirect(route('tasks.index'));


    }

    public function edit(Task $task)
    {
        return view('tasks.edit' , [
            'task'=>$task,
            'tags' => Tag::all(),
            'pms' => User::all(),
            'performers' => User::all()
        ]);
    }


    public function update(Task $task)
    {
        $task->update($this->validateTask());
        return redirect(route('tasks.show' , $task));
    }

    public function destroy()
    {
        $task = Task::find(\request()->id);
        $task->destroy(\request()->id);
        return redirect(route('tasks.index'));
    }

    protected function validateTask()
    {
        return request()->validate([
            'title' => 'required',
            'performer_id' => 'required',
            'PM_id' => 'required',
            'due_date' => 'required',
            'description' => 'required'
        ]);
    }
}
