<div>
    <h2 class="text-lg font-bold mb-4">Update Task Status</h2>
    <select style="width: 30%;"
        wire:model="status"
        wire:change="updateStatus($event.target.value)"
        class="border rounded p-2"
        onchange="hideMsgDiv()"
    >
        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <div class="mt-2 text-sm text-gray-600">
        Current status: <strong>{{ ucfirst($status) }}</strong>
    </div>
    @if($isUpdated)
        <div
            id="statusUpdateShow" class="bg-green-500 text-white px-4 py-2 rounded mt-4"
        >
            Status updated successfully!
        </div>
        
    @endif
    <script>
        function hideMsgDiv(){
            setTimeout(() => {
                document.getElementById("statusUpdateShow").style.display = "none";
            }, 2000);
        }
                
    </script>
</div>
