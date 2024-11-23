<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <ul role="list" class="divide-y divide-gray-100 mb-4">
                        <li class="flex justify-between gap-x-6 py-5" style="background: #333;border-radius: 10px 10px 0px 0px;">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto px-3">
                                    <p class="text-sm/6 font-semibold text-gray-900" style="font-size: 20px;color: #fff;">Name</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500" style="font-size: 18px;color: #fff;">Email</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end px-3">
                                <p class="mt-1 text-xs/5 text-gray-500" style="font-size: 18px;color: #fff;">Join Date</p>
                                <p class="mt-1 text-xs/5 text-gray-500" style="font-size: 18px;color: #fff;">Total Task </p>

                            </div>
                        </li>
                        @if($users)
                        @foreach($users as $user)
                            <li class="flex justify-between gap-x-2 py-2" style="border-left: 2px solid #333;border-right: 2px solid #333;border-bottom: 2px solid #333;">
                                <div class="flex min-w-0 gap-x-4">
                                    <div class="min-w-0 flex-auto px-3">
                                    <p class="text-sm/6 font-semibold text-gray-900">{{$user->name}}</p>
                                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{$user->email}}</p>
                                    </div>
                                </div>
                                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end px-3">
                                    <p class="mt-1 text-xs/5 text-gray-500">{{$user->created_at}}</p>
                                    <p class="mt-1 text-xs/5 text-black-500"><b> {{$user->tasks_count}} </b></p>
                                </div>
                            </li>
                        @endforeach
                        @endif
                      </ul>
                      {{ $users->withQueryString()->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
