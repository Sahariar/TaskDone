<x-layouts.app :title="__('Tasks')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4">
            <x-dashadmin :title="__('Tasks')" />
        </div>
        <div class="grid grid-cols-1 ">

            <div class="grid grid-cols-1 gap-x-3 lg:grid-cols-12">

                <div class="col-span-12 lg:col-span-8">
                    <div class="group flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4 my-4">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h4 class="text-gray-700 text-21 dark:text-gray-100">
                                    {{ $task->title }}
                                </h4>
                            </div>
                            <hr class="my-4 border-gray-100 dark:border-zinc-600">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <h6 class="mb-2 text-gray-700 dark:text-gray-100">Categories</h6>
                                        <p class="mb-3 text-gray-500 dark:text-zinc-100 text-15">Task</p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <h6 class="mb-2 text-gray-700 dark:text-gray-100">Post Date</h6>
                                        <p class="mb-3 text-gray-500 dark:text-zinc-100 text-15">
                                            {{ $task->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <h6 class="mb-2 text-gray-700 dark:text-gray-100">End Date</h6>
                                        <p class="mb-3 text-gray-500 dark:text-zinc-100 text-15">
                                            {{ $task->end_date }}</p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-3">
                                    <div class="text-center">
                                        <p class="mb-2 text-gray-500 dark:text-zinc-100">Project</p>
                                        <h5 class="mb-3 text-gray-700 text-15 dark:text-gray-100">
                                            {{ $task->project->name }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4 border-gray-100 dark:border-zinc-600">

                            <div class="mt-4 px-3">
                                <div class="text-gray-500 dark:text-zinc-100 text-14 flex-wrap">
                                    {{ $task->description }}
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="text-gray-500 dark:text-zinc-100 text-14 flex-wrap">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="group flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4">
                        <div class="card-body">
                            <div class="mb-3 text-center">
                                <h4 class="text-gray-700 text-21 dark:text-gray-100">
                                    Tasks Comments
                                </h4>
                            </div>
                            <div class="">
                                <ul class="space-y-10">
                                @foreach ($comments as $comment )
                                <li>
                                    <hr class="my-4 border-gray-100 dark:border-zinc-600">
                                    <p class="font-medium text-sm text-gray-800 dark:text-neutral-200">
                                        {{ $comment->comment }}
                                    </p>
                                    <div class="user-area flex  mt-2">
                                    <div class="shrink-0 size-6 bg-zinc-200 rounded-sm overflow-hidden dark:bg-zinc-700 mx-2">
                                    <div class="w-full h-full flex items-center justify-center text-sm">
                                        <img class="rounded-lg rtl:xl:ml-2" src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}">
                                    </div>
                                    </div>
                                        <p class="font-medium text-sm text-gray-800 dark:text-neutral-200">{{ $comment->user->name }}
                                            <span class="ml-2 text-xs text-gray-500 dark:text-neutral-500">
                                                {{ $comment->created_at }}
                                            </span></p>
                                    </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <hr class="my-4 border-gray-100 dark:border-zinc-600">

                            <div class="mt-4">
                                <div class="text-gray-500 dark:text-zinc-100 text-14 flex-wrap">
                                    <form>
                                        <div>
                                          <label for="hs-feedback-post-comment-textarea-1" class="block mb-2 text-sm font-medium dark:text-white">Comment</label>
                                          <div class="mt-1">
                                            <textarea id="hs-feedback-post-comment-textarea-1" name="hs-feedback-post-comment-textarea-1" rows="3" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Leave your comment here..."></textarea>
                                          </div>
                                        </div>

                                        <div class="mt-6 grid">
                                          <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Submit</button>
                                        </div>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 px-8">
                    <div class="px-4">
                        <div class="card-body">
                            <div class="group flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4">
                                <h5 class="text-gray-700 dark:text-gray-100">Task Information</h5>
                                <div class="px-2 font-medium list-unstyled mt-6">
                                    <dl class="space-y-3">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                                            <dd class="mt-1">
                                                <span
                                                    class="px-2 py-1 text-sm rounded-full {{ $task->status ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $task->status }}
                                                </span>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Priority</dt>
                                            <dd class="mt-1">{{ $task->priority ?? 'Not provided' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Estimated Hours</dt>
                                            <dd class="mt-1">
                                                <p class="">
                                                    {{ $task->estimated_hours }}
                                                </p>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Actual Hours</dt>
                                            <dd class="mt-1">
                                                <p class="">
                                                    {{ $task->actual_hours }}
                                                </p>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Progress</dt>
                                            <dd class="mt-1">
                                                <p class="">
                                                    {{ $task->progress }}
                                                </p>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                            </div>
                            <div class="mt-12 group flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 p-4">
                                <h5 class="mb-4 font-medium text-gray-700 dark:text-gray-100">Persons Working on This task</h5>
                                <p class="">
                                    {{ $task->assignee->name }}
                                </p>
                            </div>

                        </div>
</x-layouts.app>
