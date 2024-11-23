<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/react@17/umd/react.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom@17/umd/react-dom.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="task-dashboard"></div>
                </div>
            </div>
        </div>
    </div>
    

    <script type="text/babel" src="{{ asset('js/tasks/TaskList.js')}}"></script>
    <script type="text/babel" src="{{ asset('js/tasks/AddTaskModal.js')}}"></script>
    <script type="text/babel" src="{{ asset('js/tasks/EditTaskModal.js')}}"></script>
    <script type="text/babel" src="{{ asset('js/tasks/DeleteTaskModal.js')}}"></script>
    <script type="text/babel" src="{{ asset('js/Notification.js')}}"></script>

    

    <!-- Correct Asset Path -->
    <script type="text/babel" src="{{ asset('js/task-dashboard.js') }}"></script>
</x-app-layout>
