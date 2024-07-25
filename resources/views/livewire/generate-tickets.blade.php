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
        <div>Tickets</div>
        <div class="mr-2">
        </div>
    </div>
    <div class="mt-5 flex justify-between">
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
                            <button type="button" wire:click="orderBy('event_id')"
                                class="text-sm font-medium text-gray-300 uppercase">QR Code
                            </button>
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider whitespace-nowrap">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('event_id')"
                                class="text-sm font-medium text-gray-300 uppercase">Ticket ID
                            </button>
                        </div>
                        <div class="ms-2">
                            <x-sort-icon sortField="ticket_code" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('name')"
                                class="text-sm font-medium text-gray-300 uppercase">Event Name
                            </button>
                        </div>
                        <div class="ms-2">
                        </div>
                    </div>
                </th>
                <th class="px-4 py-2 text-left tracking-wider">
                    <div class="grid grid-cols-2">
                        <div class="content-center">
                            <button type="button" wire:click="orderBy('name')"
                                class="text-sm font-medium text-gray-300 uppercase">Ticket Name
                            </button>
                        </div>
                        <div class="ms-2">
                        </div>
                    </div>
                </th>
                <th
                    class="px-4 py-2 text-left text-sm font-medium text-gray-300 uppercase tracking-wider whitespace-nowrap">
                    Action
                </th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($data as $item)
                <tr>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 whitespace-nowrap"><img
                            src="{{ Storage::url('qr-code/' . $item->ticket_code . '.png') }}" width="100"></td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $item->ticket_code }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $item->ticket->event->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $item->ticket->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <x-button-warning wire:click="" wire:loading.attr="disabled">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                              </svg>

                            </x-button-info>
                            <x-button-info wire:click="" wire:loading.attr="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                  </svg>

                            </x-button-info>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $data->links() }}
    </div>
</div>
