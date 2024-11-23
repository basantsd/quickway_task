<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskStatus extends Component
{
    public $task;
    public $status;
    public $isUpdated = false;

    // Initialize the component with the task's current status
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->status = $task->status;
    }

    // Method to update the task status
    public function updateStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->task->update(['status' => $newStatus]);
        $this->isUpdated = true;
    }

    public function render()
    {
        return view('livewire.task-status');
    }
}
