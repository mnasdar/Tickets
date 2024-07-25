<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="grid grid-cols-12 gap-x-4 sm:col-span-4">
        <div class="col-span-6">
            <div class="form-control" id="reader" width="400px"></div>
        </div>
        <div class="col-span-6">
            <form wire:submit.prevent="scanTicket">
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input autofocus id="ticket_code" type="text" class="mt-1 block w-full" wire:model.defer="form.ticket_code" />
                        <x-input-error for="form.ticket_code" class="mt-2" />
                    </div>
                    <x-button-save class="mt-4" wire:loading.attr="disabled">
                        {{ __('Scan') }}
                        </x-danger-button>
            </form>
        </div>
    </div>
</div>

@vite(['resources/js/scanqr.js'])
