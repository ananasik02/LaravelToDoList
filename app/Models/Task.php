<?php

namespace App\Models;

use App\Jobs\SendNotificarionProcess;
use App\Models\User;
use App\Notifications\RunningOutDeadline;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function performer()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'performer_id');
    }

    public function pm()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'pm_id');
    }

    public function calculateTimeLeft($id)
    {
        if(Task::find($id))
        {
            $startTime = new DateTime();
            $finishTime=new DateTime(Task::find($id)->due_date);
            $timeleft = $startTime->diff($finishTime, false);
            if($timeleft->invert){
                $timeleft = 0;
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
        if($timeleft)
        {
            return $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
        }
        return 0;
    }

    public function checkDeadline($id)
    {
        $task = Task::find($id);
        if ($task) {
            $timeleft = $this->calculateTimeLeft($id);
            if ($timeleft) {
                $days = $timeleft->d - 1;
                $delay = now()->addDays($days);
                $job = (new SendNotificarionProcess($task))->delay($delay);
                $this->dispatch($job);
            }
            else {
                return 0;

            }
        } else {
            return 0;
        }
    }
}
