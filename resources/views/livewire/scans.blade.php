<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="flex justify-between">
        <div class="p-2">
            <input wire:model.live.debounce.250ms="search" type="search" placeholder=""
                class="bg-slate-800 text-gray-300 shadow appearance-none border rounded w-full">
        </div>
    </div>
    <table class="mt-3 min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-4 py-2 text-left tracking-wider whitespace-nowrap inline-block">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('id')"
                                class="text-sm font-medium text-gray-300 uppercase">No
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider whitespace-nowrap">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('name')"
                                class="text-sm font-medium text-gray-300 uppercase">Name
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider whitespace-nowrap">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('category')"
                                class="text-sm font-medium text-gray-300 uppercase">Category
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="category" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider whitespace-nowrap">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('start_date')"
                                class="text-sm font-medium text-gray-300 uppercase">Start Date
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="start_date" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider whitespace-nowrap">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('end_date')"
                                class="text-sm font-medium text-gray-300 uppercase">End Date
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="end_date" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('location')"
                                class="text-sm font-medium text-gray-300 uppercase">Location
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="location" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th
                    class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider whitespace-nowrap">
                    Status
                </th>
                <th
                    class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider whitespace-nowrap">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($events as $event)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $event->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $event->category }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $event->start_date }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $event->end_date }}</td>
                    <td class="px-4 py-2 whitespace">{{ $event->location }}</td>
                    <td class="px-4 py-2 whitespace-nowrap"><span
                            class="bg-green-700 rounded px-1 py-0">{{ $event->status ? 'Active' : 'Not Active' }}</span>
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">

                        <x-button-warning data-tooltip-target="tooltip-default{{ $event->id }}"
                            wire:click="redirectScanTicket({{ $event->id }})" wire:loading.attr="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                            </svg>
                        </x-button-warning>

                        <div id="tooltip-default{{ $event->id }}" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Scan QR
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
