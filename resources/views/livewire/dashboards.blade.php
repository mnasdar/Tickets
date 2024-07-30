<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Welcome to Tickets!
    </h1>

    <div class="mt-6 grid grid-cols-3 md:grid-cols-3 gap-4">

        <div
            class="max-w-sm p-6 bg-blue-700 border border-gray-200 rounded-lg shadow dark:bg-blue-800 dark:border-blue-700">
            <a href="{{ route('event') }}">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-gray-300">Events</h5>
            </a>
            <h5 class="mb-3 text-2xl font-bold text-gray-700 dark:text-white">{{ $count_event }}</h5>
        </div>

        <div
            class="max-w-sm p-6 bg-yellow-600 border border-gray-200 rounded-lg shadow dark:bg-yellow-800 dark:border-yellow-700">
            <a href="{{ route('ticket') }}">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-gray-300">Tickets</h5>
            </a>
            <h5 class="mb-3 text-2xl font-bold text-gray-700 dark:text-white">{{ $count_ticket }}</h5>
        </div>

        <div
            class="max-w-sm p-6 bg-green-600 border border-gray-200 rounded-lg shadow dark:bg-green-800 dark:border-green-700">
            <a href="{{ route('scan') }}">
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-gray-300">Generated Tickets</h5>
            </a>
            <h5 class="mb-3 text-2xl font-bold text-gray-700 dark:text-white">{{ $count_generate_ticket }}</h5>
        </div>

    </div>
</div>
