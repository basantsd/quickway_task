<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function show($id): View 
    {
        $task = Task::find($id);
        return view('task-view',compact('task'));
    }
}