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
        if(!User::find($id)){
            return 0;
        }else{
            $usr = User::find($id);
            return $usr->name;
        }
    }

    public function calculateTimeLeft($id)
    {
        if(Task::find($id))
        {
            $startTime = new DateTime();
            $finishTime=new DateTime(Task::find($id)->due_date);
            $timeleft = $startTime->diff($finishTime, false);
            if($timeleft->invert){
                $timeleft = -1;
            }
        }
        else
        {
            $timeleft=0;
        }
        return $timeleft;

    }

    public function displayTimeLeft($id)
    {
        $timeleft = $this->calculateTimeLeft($id);
        return $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
    }

    public function checkDeadline($id)
    {
        $task=Task::find($id);
        if($task){
            return 0;
        }

        $timeleft = $this->calculateTimeLeft($id);
        $days = $timeleft->d-1;

        if($days<1){
            return 0;
        }

        $delay = now() -> addDays($days);
        $job = (new SendNotificarionProcess($task))->delay($delay);
        $this->dispatch($job);
    }
}
