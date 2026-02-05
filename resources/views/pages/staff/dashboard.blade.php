@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-12 gap-4 md:gap-6">
        <div class="col-span-12 space-y-6">
            <div class="grid grid-cols-1 gap-4 md:gap-6">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 md:p-6">
                    <div class="flex items-end justify-between mt-5">
                        <div>
                            <span class="text-xl xl:text-9xl sm:text-7xl text-gray-500 dark:text-gray-400">Welcome,
                                {{ auth()->user()->name }}
                                :3</span>
                            <h4 class="mt-2 font-bold text-gray-800 text-2xl sm:text-title-sm dark:text-white/90">
                                Have a great day at work!
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 md:p-6">
                    <div class="flex justify-between flex-col mt-5 gap-5">
                        <div>
                            <h4 class="mt-2 font-bold text-gray-800 text-title-sm dark:text-white/90">
                                Here some random images
                            </h4>
                        </div>
                        <div>
                            <img src="https://picsum.photos/200/300" alt="Welcome Image" class="w-50 h-full">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
