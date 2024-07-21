<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">Event</h1>
    <div class="mt-6">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">No.</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">Category
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider whitespace-nowrap">Start Date
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider whitespace-nowrap">End Date
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">Location
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">Status
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider">Action
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
                        <td class="px-4 py-2 whitespace-nowrap">{{ $event->status ? 'Active' : 'Not Active'}}</td>
                        <td class="px-4 py-2 whitespace-nowrap">
                            <x-info-button wire:click="confirmEventDeletion({{ $event->id }})" wire:loading.attr="disabled">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                  </svg>


                            </x-info-button>
                            <x-danger-button wire:click="confirmEventDeletion({{ $event->id }})" wire:loading.attr="disabled">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                  </svg>

                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $events->links() }}
        </div>
        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingEventDeletion">
            <x-slot name="title">
                {{ __('Delete') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete your data? Once your data is deleted, all of its resources and data will be permanently deleted') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingEventDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
