<?php

namespace Tests\Unit;

use App\Models\Task;
use PHPUnit\Framework\TestCase;

class TimeLeftTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_not_found_user_returns_zero_timeleft()
    {
        $timeleft = (new Task())->calculateTimeLeft(1, 200);
        $this->assertEquals(null, $timeleft);
    }
}
