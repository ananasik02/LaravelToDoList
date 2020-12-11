<?php

namespace App\Jobs;

use App\Models\Task;
use App\Models\User;
use App\Notifications\RunningOutDeadline;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotificarionProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $task;
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::find($this->task->performer_id)->notify(
            (new RunningOutDeadline($this->task->id, $this->task->title))
        );

    }
}
