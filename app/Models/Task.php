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
        return $timeleft->d . "d " . $timeleft->h . "h " . $timeleft ->i . "m ";
    }

    public function checkDeadline($id, $performer_id)
    {
        $startTime = new DateTime();
        $finishTime=new DateTime(Task::find($id)->due_date);
        $timeleft = $startTime->diff($finishTime, true);
        $delay = now()->addDays($timeleft->d - 1 );
        User::find($performer_id)->notify(
            (new RunningOutDeadline())->delay($delay)
        );
    }

    public function isCompleted() : string
    {
        $attHtml = "";

        if($this->completed==1){
            $attHtml .= '<p>Yes</p>';
        }else{

            $attHtml .= '<p>No</p>
                <form action="?action=check-box" method="post">
                    <input type="checkbox" name="done" value="' . $this->id .
                ' " />
                    <input type="submit" name="formSubmit" hidden="true" value=" " </form> ';
        }

        return $attHtml;
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
