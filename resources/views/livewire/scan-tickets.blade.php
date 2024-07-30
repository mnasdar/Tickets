<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="grid grid-cols-12 gap-x-4 sm:col-span-4">
        <div class="col-span-6">
            <div class="rounded p-2" id="reader" width="400px"></div>
        </div>
        <div class="col-span-6">
            <form action="{{ route('scan.Ticket', $event_id) }}" method="post">
                @csrf
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="ticket_code" value="{{ __('Ticket Code') }}" />
                    <input autofocus name="ticket_code" id="ticket_code" type="text"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                    <x-input-error for="ticket_code" class="mt-2" />
                </div>
                <x-button-save class="mt-4" wire:loading.attr="disabled">
                    {{ __('Scan') }}
                </x-button-save>
            </form>
        </div>
    </div>
</div>

@vite(['resources/js/scanqr.js'])
