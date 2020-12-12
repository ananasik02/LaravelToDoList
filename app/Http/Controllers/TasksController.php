<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

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
        return redirect(route('tasks.index'));


    }

    public function edit(Task $task)
    {
        return view('tasks.edit' , ['task'=>$task]);
    }

    public function update(Task $task)
    {
        $task->update($this->validateTask());
        return redirect(route('tasks.show' , $task));
    }

    public function destroy()
    {

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
