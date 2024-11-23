<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-gray-50 py-10 sm:py-8">
                        <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8">
                          <h2 class="text-center text-base/7 font-semibold text-indigo-600">Task Overview</h2>
                          <p class="mx-auto mt-2 max-w-lg text-balance text-center text-4xl font-semibold tracking-tight text-gray-950 sm:text-5xl">Task You Have : {{$totalTask}}</p>
                          <p class="mx-auto mt-2 max-w-lg text-balance text-center text-1xl font-semibold tracking-tight text-gray-950 sm:text-1xl">Pending :  {{$pendingTask}} | Completed :  {{$completedTask}}</p>
                          <div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-1 lg:grid-rows-1">
                            <div class="relative lg:row-span-2">
                              <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>
                              <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
                                <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">
                                  <p class="mt-2 text-lg font-semibold tracking-tight text-gray-950 max-lg:text-center ">Last Top 10 Task</p>
                                  <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center"></p>
                                </div>
                                <div class="relative min-h-[30rem] w-full grow [container-type:inline-size] max-lg:mx-auto max-lg:max-w-sm">
                                  <div class="absolute inset-x-10 bottom-0 top-2 " style="overflow-y: auto;"> 
                                    <ul role="list" class="divide-y divide-gray-100">
                                       @if($lastFiveTask)
                                       @foreach($lastFiveTask as $task)
                                        
                                       
                                        <li class="flex justify-between gap-x-6 py-5">
                                          <div class="flex min-w-0 gap-x-4">
                                            <div class="min-w-0 flex-auto">
                                              <p class="text-sm/6 font-semibold text-gray-900">{{$task->title}}</p>
                                              <span
                                                className="ml-2 text-sm px-2 py-1 rounded" style="{{ $task->status === 'pending' ? 'background: #ff7c7c;padding: 4px 17px;border-radius: 10px;font-size: 12px;color: #fff;' : 'background: #7cff7e;padding: 4px 17px;border-radius: 10px;font-size: 12px;' }}">
                                                {{ucfirst($task->status)}}
                                            </span>
                                            </div>
                                          </div>
                                          <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                            {{-- <p class="text-sm/6 text-gray-900">Co-Founder / CEO</p> --}}
                                            <p class="mt-1 text-xs/5 text-gray-500">Due date : <b><time >{{$task->due_date}}</time></b></p>
                                          </div>
                                        </li>
                                        @endforeach
                                        @endif
                                      </ul>
                                      
                                  </div>
                                </div>
                              </div>
                              <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 lg:rounded-l-[2rem]"></div>
                            </div>
                            
                           
                          </div>
                        </div>
                      </div>
                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
