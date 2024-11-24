<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'sanctum');
    }

    public function test_it_can_list_tasks()
    {
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'First Task']);
        Task::factory()->create(['user_id' => $this->user->id, 'title' => 'Second Task']);

        $response = $this->getJson('api/tasks');
        
        $response->assertOk()
                 ->assertJsonFragment(['title' => 'First Task'])
                 ->assertJsonFragment(['title' => 'Second Task']);
    }

    public function test_it_can_add_a_task()
    {
        $response = $this->postJson('api/tasks/add', [
            'title' => 'New Task',
            'description' => 'Task Description',
            'due_date' => now()->addDay()->toDateString(),
        ]);

        $response->assertCreated()
                 ->assertJsonFragment(['title' => 'New Task']);
                 
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_it_can_update_a_task()
    {
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'title' => 'Old Title',
        ]);

        $response = $this->putJson("api/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'due_date' => now()->addDay()->toDateString(),
        ]);

        $response->assertOk()
                 ->assertJsonFragment(['title' => 'Updated Title']);
                 
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_it_can_delete_a_task()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->deleteJson("api/tasks/{$task->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_it_can_update_task_status()
    {
        $task = Task::factory()->create([
            'user_id' => $this->user->id,
            'status' => 'pending',
        ]);

        $response = $this->patchJson("api/tasks/{$task->id}/status", [
            'status' => 'completed',
        ]);

        $response->assertOk()
                 ->assertJson(['status' => 'completed']);
                 
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'completed',
        ]);
    }
}
