<?php

namespace Tests\Unit;

use App\Models\Task;
use Tests\TestCase;
class TaskTest extends TestCase
{

    public function test_find_links_with_not_existing_user_returns_zero()
    {
        $links = (new Task())->findLinks(1000);
        $this->assertEquals(0, $links);
    }

    public function test_not_found_task_returns_zero()
    {
        $timeleft = (new Task())->calculateTimeLeft(1000);
        $this->assertEquals(0, $timeleft);
    }

    public function test_late_deadline_returns_zero()
    {
        $task = Task::factory()->create(['due_date' => '1975-11-13']);
        $timeleft = $task->calculateTimeLeft($task->id);
        $this->assertEquals(-1, $timeleft);

    }

    public function test_check_deadline_not_existing_task_returns_zero()
    {
        $check = (new Task())->checkDeadline(1000);
        $this->assertEquals(0, $check);
    }

    public function test_no_days_to_delay_notifications()
    {

    }
}
