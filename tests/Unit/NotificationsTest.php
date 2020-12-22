<?php

namespace Tests\Unit;

use App\Models\User;
use App\Notifications\TaskAssigned;
use PHPUnit\Framework\TestCase;

class NotificationsTest extends TestCase
{
    public  function test_notify_not_existing_user()
    {
       // $this->assertEquals(User::find(1000)->notify(new TaskAssigned(1, "dddddd")), null);
    }
}
