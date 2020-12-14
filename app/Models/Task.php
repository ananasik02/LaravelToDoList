<?php

namespace App\Models;

use App\Jobs\SendNotificarionProcess;
use App\Models\User;
use App\Notifications\RunningOutDeadline;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function findLinks($id)
    {
        $usr = User::find($id);
        return $usr->name;
    }

    public function calculateTimeLeft($id, $performer_id)
    {
        $startTime = new DateTime();
        $finishTime=new DateTime(Task::find($id)->due_date);
        $timeleft = $startTime->diff($finishTime, true);
        return $timeleft;
        //return $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
    }

    public function displayTimeLeft($id, $performer_id)
    {
        $timeleft = $this->calculateTimeLeft($id, $performer_id);
        return $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
    }

    public function checkDeadline($id, $performer_id)
    {
        $task=Task::find($id);
        $startTime = new DateTime();
        $finishTime=new DateTime($task->due_date);
        $timeleft = $startTime->diff($finishTime, true);
        $days = $timeleft->d-1;
        $delay = now() -> addMinutes(5);

        $job = (new SendNotificarionProcess($task))->delay($delay);
        $this->dispatch($job);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
