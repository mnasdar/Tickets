<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    @if (session()->has('success'))
        <div class="flex item-center bg-green-100 text-green-800 text-md rounded font-bold px-4 py-3 relative"
            role="alert" x-data="{ show: true }" x-show="show">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 me-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <p>{{ session('success') }}</p>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" role="button" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
    @elseif (session()->has('danger'))
        <div class="flex item-center bg-red-100 text-red-800 text-md rounded font-bold px-4 py-3 relative"
            role="alert" x-data="{ show: true }" x-show="show">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 me-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <p>{{ session('danger') }}</p>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" role="button" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
    @endif

    <div class="mt-5 text-2xl flex justify-between">
        <div>Events</div>
        <div class="mr-2">
            <x-button-primary wire:click="confirmEventAdd">
                Add New Event
            </x-button-primary>
        </div>
        <!-- Add Event Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingEventAdd">
            <x-slot name="title">
                {{ $event ? 'Edit Event' : 'Add Event' }}
            </x-slot>

            <form wire:submit="saveEvent">
                <x-slot name="content">
                    <div class="mt-4 col-span-6 sm:col-span-4">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="form.name" />
                        <x-input-error for="form.name" class="mt-2" />
                    </div>
                    <div class="mt-4 col-span-6 sm:col-span-4">
                        <x-label for="category" value="{{ __('Category') }}" />
                        <x-select id="category" class="mt-1 block w-full" wire:model.defer="form.category">
                            <option value="">Pilih</option>
                            <option value="Music">Music</option>
                            <option value="Festival">Festival</option>
                            <option value="Food Court">Food Court</option>
                        </x-select>
                        <x-input-error for="form.category" class="mt-2" />
                    </div>
                    <div class="mt-4 col-span-6 sm:col-span-4">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-text-area id="description" class="mt-1 block w-full" wire:model.defer="form.description" />
                        <x-input-error for="form.description" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-12 mt-4 sm:col-span-4">
                        <div class="col-span-6">
                            <x-label for="start_date" value="{{ __('Start Date') }}" />
                            <x-input id="start_date" type="date" class="mt-1 block w-50"
                                wire:model.defer="form.start_date" />
                            <x-input-error for="form.start_date" class="mt-2" />
                        </div>
                        <div class="col-span-6">
                            <x-label for="end_date" value="{{ __('End Date') }}" />
                            <x-input id="end_date" type="date" class="mt-1 block w-50"
                                wire:model.defer="form.end_date" />
                            <x-input-error for="form.end_date" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4 col-span-6 sm:col-span-4">
                        <x-label for="location" value="{{ __('Location') }}" />
                        <x-input id="location" type="text" class="mt-1 block w-full"
                            wire:model.defer="form.location" />
                        <x-input-error for="form.location" class="mt-2" />
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-secondary-button wire:click="$set('confirmingEventAdd',false)" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-button-save class="ms-3" wire:click="saveEvent()" wire:loading.attr="disabled">
                        {{ __('Save') }}
                        </x-danger-button>

                </x-slot>
            </form>
        </x-dialog-modal>
    </div>
    <div class="mt-5 flex justify-between">
        <div class="p-2">
            <input wire:model.live.debounce.250ms="search" type="search" placeholder=""
                class="bg-slate-800 text-gray-300 shadow appearance-none border rounded w-full">
        </div>
        <div class="mr-2">
            <input type="checkbox" class="bg-slate-800 border rounded mr-2 leading-tight" wire:model.live="active" />
            Active Only
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
                @if (!$active)
                    <th
                        class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider whitespace-nowrap">
                        Status
                @endif
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
                    @if (!$active)
                        <td class="px-4 py-2 whitespace-nowrap">
                            @if ($event->status == 1)
                            <span class="bg-green-700 rounded px-1 py-0">
                                {{ __('Active') }}
                            </span>
                            @else
                            <span class="bg-blue-700 rounded px-1 py-0">
                                {{ __('Done') }}
                            </span>
                            @endif
                        </td>
                    @endif
                    <td class="px-4 py-2 whitespace-nowrap">

                        @if ($event->status == 0)
                            <x-button-info disabled wire:click="confirmEventEdit({{ $event->id }})"
                                class="disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500"
                                wire:loading.attr="disabled">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </x-button-info>
                            <x-danger-button disabled wire:click="confirmEventDeletion({{ $event->id }})"
                                wire:loading.attr="disabled"
                                class="disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </x-danger-button>
                        @else
                            <x-button-info data-tooltip-target="tooltip-info{{ $event->id }}"
                                wire:click="confirmEventEdit({{ $event->id }})" wire:loading.attr="disabled">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                </svg>
                            </x-button-info>
                            <x-tooltip id='tooltip-info{{ $event->id }}'>Edit</x-tooltip>
                            <x-danger-button data-tooltip-target="tooltip-danger{{ $event->id }}"
                                wire:click="confirmEventDeletion({{ $event->id }})" wire:loading.attr="disabled"
                                class="disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </x-danger-button>
                            <x-tooltip id='tooltip-danger{{ $event->id }}'>Delete</x-tooltip>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $events->links() }}
    </div>
    <!-- Delete Event Confirmation Modal -->
    <x-dialog-modal wire:model.live="confirmingEventDeletion">
        <x-slot name="title">
            {{ __('Delete') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete your data? Once your data is deleted, all of its resources and data will be permanently deleted') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingEventDeletion',false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteEvent({{ $confirmingEventDeletion }})"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
