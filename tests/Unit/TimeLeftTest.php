<?php

namespace Tests\Unit;

use App\Models\Task;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class TimeLeftTest extends TestCase
{
    use RefreshDatabase;
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
}
