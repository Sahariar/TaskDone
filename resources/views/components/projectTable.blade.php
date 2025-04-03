<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-neutral-700">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Name</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">budget</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Client Name</th>
                <th scope="col" class="px-6 py-3 text-xs text-end font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @foreach ($projects as $project)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $project->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">${{ $project->budget }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $project->status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $project->client_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <div class="p-2">
                        <a href="{{ route('admin.projects.show',$project->id) }}" title="View Project" class="py-2 px-4 mx-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-blue-600 text-blue-600 hover:border-blue-500 hover:text-blue-500 focus:outline-hidden focus:border-blue-500 focus:text-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:border-blue-500 dark:text-blue-500 dark:hover:text-blue-400 dark:hover:border-blue-400">
                            View
                        </a>
                        <a href="{{ route('admin.projects.show',$project->id) }}" title="View Project" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-hidden focus:bg-red-600 disabled:opacity-50 disabled:pointer-events-none">
                            Delete
                        </a>
                    </div>
                    </td>
                  </tr>
                @endforeach

            </tbody>
          </table>
          {!! $projects->links() !!}
        </div>
      </div>
    </div>
  </div>
