<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RequestsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_auth_routing()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_non_authorized_routing()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(500);

        $response = $this->get('/tasks/create');
        $response->assertStatus(500);

        $response = $this->get('/notifications');
        $response->assertStatus(500);

    }

    public function test_non_authorized_parametred_routing()
    {
        $task = Task::factory()->create();

        $response = $this->get('/tasks/' . $task->id );
        $response->assertStatus(500);

        $response = $this->get('/tasks/' . $task->id . '/edit');
        $response->assertStatus(500);

        $response = $this->get('/tasks/'. $task->id . '/delete');
        $response->assertStatus(500);
    }

    public function test_interacting_with_the_session()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/tasks');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/tasks/create');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/notifications');
        $response->assertStatus(200);

    }

    public function test_authorized_parametred_routing()
    {
        $task = Task::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tasks/' . $task->id );
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/tasks/' . $task->id . '/edit');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/tasks/'. $task->id . '/delete');
        $response->assertStatus(200);
    }

    public function test_authorized_parametred_routing_to_not_existing_test()
    {
        $task = Task::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tasks/' . $task->id+1 );
        $response->assertStatus(404);

        $response = $this->actingAs($user)->get('/tasks/' . $task->id+1 . '/edit');
        $response->assertStatus(404);

        $response = $this->actingAs($user)->get('/tasks/'. $task->id+1 . '/delete');
        $response->assertStatus(404);
    }

}
