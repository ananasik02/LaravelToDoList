<?php

namespace App\Models;

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

    public function calculateTimeLeft($id, $performer_id)
    {
        $startTime = new DateTime();
        $finishTime=new DateTime(Task::find($id)->due_date);
        $timeleft = $startTime->diff($finishTime, true);
        if($timeleft->d < 1){
            Notification::send(User::find($performer_id), new RunningOutDeadline());
        }
        return $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
