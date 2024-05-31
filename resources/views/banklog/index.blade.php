<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Bank Logs</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('dashboard') }}" class="inline-block w-full"> Go Back </a>
        </x-button>

        @if ( $balance < config('app.bank_minimum_balance')  )
        <x-button class="mt-6 ml-2 shadow-xl">
            <a href="{{ route('events.create') }}" class="inline-block w-full"> Plan A Publicity Event </a>
        </x-button>
        @endif
    </header>

        @if ( $balance < config('app.bank_minimum_balance')  )
            <p class="text-red-500 font-bold w-full text-center text-lg mt-7"> Bank balance is less than configured minimum amount, plan a publicity event immediately.</p>
        @endif
    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-8/12 mx-auto">
        @if ($logs->count())
            <div class="border border-gray-400 rounded-md shadow-xl">
                <table class="table-auto w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-2"> Amount </th>
                            <th> Balance </th>
                            <th> Type </th>
                            <th> Date </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                @foreach ($logs as $log)
                    <tr class="border border-t-gray-400 {{ $log->type == "incoming" ? "bg-green-300" : "bg-red-300" }} ">
                        <th class="p-2 font-normal"> {{ $log->amount }} </th>
                        <th class="font-normal"> {{ $log->balance }} </th>
                        <th class="font-normal"> {{ ucfirst($log->type) }} </th>
                        <th class="font-normal"> {{ $log->created_at }} </th>
                        <th> <a href="{{ route('banklogs.show', $log->id) }}" class="text-blue-500"> View </a> </th>
                    </tr>
                @endforeach
                </table>
            </div>

            {{ $logs->links() }}
    @else
        <p class="text-center p-4">Seems like there aren't any logs. Check again later.</p>
    @endif
    </main>
</x-layout>
