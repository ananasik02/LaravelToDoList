<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class TaskTest extends TestCase
{
    use RefreshDatabase;
    public function test_not_found_task_returns_zero()
    {
        $check = (new Task())->checkDeadline(1000);
        $this->assertEquals(0, $check);

        $check = (new Task())->calculateTimeLeft(1000);
        $this->assertEquals(0, $check);

        $check = (new Task())->displayTimeLeft(1000);
        $this->assertEquals(0, $check);
    }

    public function test_late_deadline_returns_zero()
    {
        $task = Task::factory()->create(['due_date' => '1975-11-13']);
        $timeleft = $task->calculateTimeLeft($task->id);
        $this->assertEquals(0, $timeleft);

        $displayTimeLeft= $task->displayTimeLeft($task->id);
        $this->assertEquals(0, $displayTimeLeft);
    }

   public function test_no_time_to_delay_notification_returns_zero()
   {
       $task = Task::factory()->create(['due_date' => now()->addHour()]);
       $check= $task->checkDeadline($task->id);
       $this->assertEquals(0, $check);
   }

}
