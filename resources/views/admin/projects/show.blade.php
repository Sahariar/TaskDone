<x-layouts.app :title="__('Projects')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4">
            <x-dashadmin :title="__('Projects')" />
        </div>
        <div class="grid grid-cols-1 ">

            <div class="grid grid-cols-1 gap-x-3 lg:grid-cols-12">

                <div class="col-span-12 lg:col-span-8">
                    <div class="group flex flex-col h-full bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h2 class="text-gray-700 text-2xl font-bold dark:text-gray-100 py-4">
                                    {{ $project->name }}
                                </h2>
                            </div>
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <h6 class="mb-2 text-gray-700 dark:text-gray-100">Categories</h6>
                                        <p class="mb-3 text-gray-500 dark:text-zinc-100 text-15">Project</p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <h6 class="mb-2 text-gray-700 dark:text-gray-100">Post Date</h6>
                                        <p class="mb-3 text-gray-500 dark:text-zinc-100 text-15">
                                            {{ $project->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <h6 class="mb-2 text-gray-700 dark:text-gray-100">End Date</h6>
                                        <p class="mb-3 text-gray-500 dark:text-zinc-100 text-15">
                                            {{ $project->end_date }}</p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <p class="mb-2 text-gray-500 dark:text-zinc-100">Client</p>
                                        <h5 class="mb-3 text-gray-700 text-15 dark:text-gray-100">
                                            {{ $project->client_name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4 border-gray-100 dark:border-zinc-600">

                            <div class="mt-4 px-3">
                                <div class="text-gray-500 dark:text-zinc-100 text-14 flex-wrap">
                                    {{ $project->description }}
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="text-gray-500 dark:text-zinc-100 text-14 flex-wrap">
                                    <x-taskTable :tasks="$tasks" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 px-8">
                    <div class="p-4">
                        <div class="card-body">
                            <div class="mt-8 group flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4">
                                <h5 class="text-gray-700 dark:text-gray-100">Project Information</h5>
                                <div class="px-2 font-medium list-unstyled mt-6">
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                                            <dd class="mt-1">
                                                <span
                                                    class="px-2 py-1 text-sm rounded-full {{ $project->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $project->status }}
                                                </span>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                            <dd class="mt-1">${{ $project->budget ?? 'Not provided' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Project Manager</dt>
                                            <dd class="mt-1">
                                                <p class="">
                                                    {{ $project->user->name }}
                                                </p>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                            </div>
                            <div class="mt-12 group flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4">
                                <h5 class="mb-4 font-medium text-gray-700 dark:text-gray-100">Persons Working on This Project</h5>
                                <ul class="px-2 font-medium list-unstyled">
                                @foreach ($tasks as $task)
                                <li>
                                    <a href="#" class="block py-2 text-gray-700 border-b border-gray-50 dark:text-gray-100 dark:border-zinc-600">{{ $task->assignee->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            </div>

                        </div>
</x-layouts.app>
