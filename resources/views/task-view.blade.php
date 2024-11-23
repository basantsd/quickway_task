<x-app-layout>
    @livewireStyles

    <!-- React and Axios -->
    <script src="/livewire/livewire.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Task View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="bg-white py-1 sm:py-1">
                        <div class="mx-auto max-w-7xl px-6 lg:px-8">
                          <div class="mx-auto max-w-2xl lg:text-center">
                            <h2 class="text-base/7 font-semibold text-indigo-600">Task Details</h2>
                            <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl lg:text-balance">{{$task->title}}</p>
                            <p class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-red-900 sm:text-2xl lg:text-balance">Due Date : {{$task->due_date}}</p>
                            @livewire('task-status', ['task' => $task])
                           
                            <p class="mt-6 text-lg/8 text-gray-600">{{$task->description}}</p>
                          </div>
                          
                      </div>
                      

                </div>
            </div>
        </div>
    </div>

    
    
    
    @livewireScripts
</x-app-layout>
