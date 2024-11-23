<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function index(): View 
    {
        $taskQuery = Task::query();

        if (!auth()->user()->isAdmin()) {
            $taskQuery->where('user_id', auth()->id());
        }

        // Fetch counts and latest tasks in a single query
        $totalTask = (clone $taskQuery)->count();
        $pendingTask = (clone $taskQuery)->where('status', 'pending')->count();
        $completedTask = (clone $taskQuery)->where('status', 'completed')->count();
        $lastFiveTask = $taskQuery->latest('created_at')->take(10)->get();


        return view('dashboard',compact('totalTask','lastFiveTask','pendingTask','completedTask'));
    }

}