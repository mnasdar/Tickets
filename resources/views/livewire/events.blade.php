<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Event
    </h1>
    <div class="mt-6">
        <table id="basic-datatable" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">No.</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Name</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Category</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Start Date</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">End Date</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Location</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Action</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $event->name }}</td>
                        <td class="px-4 py-2">{{ $event->category }}</td>
                        <td class="px-4 py-2">{{ $event->start_date }}</td>
                        <td class="px-4 py-2">{{ $event->end_date }}</td>
                        <td class="px-4 py-2">{{ $event->location }}</td>
                        <td class="px-4 py-2">edit delete</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>

