<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search', '');
        $tasks = Task::query();

        if (!auth()->user()->isAdmin()) {
            $tasks->where('user_id', auth()->id());
        }

        if ($status !== 'all') {
            $tasks->where('status', $status);
        }

        if ($search) {
            $tasks->where('title', 'like', "%$search%");
        }

        return $tasks->orderBy('due_date', 'DESC')->paginate(10);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        return Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);
        
        $task->update($request->only(['title', 'description', 'due_date']));
        return $task;
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();
        return response(null, 204);
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->save();

        return response()->json(['status' => $task->status], 200);
    }

}
