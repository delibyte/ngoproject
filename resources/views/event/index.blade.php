<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            All <span class="text-blue-500">Events</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('events.create') }}" class="inline-block w-full"> Schedule New Event </a>
        </x-button>

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($events->count())
            <table class="table-auto w-full">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="w-2/12 p-2"> Event Name </th>
                        <th class="w-7/12"> Description </th>
                        <th class="w-2/12"> Scheduled At </th>
                        <th class="pr-2"> Action </th>
                    </tr>
                </thead>
                @foreach ($events as $event)
                    <tr class="border border-t-gray-400">
                        <th class="p-2"> {{ ucfirst($event->name) }} </th>
                        <th class="p-2 text-left font-normal"> {{ $event->description }} </th>
                        <th class="font-normal"> {{ $event->held_at }} </th>
                        <th> <a href="{{ route('events.edit', $event->id) }}" class="text-blue-500"> Edit </a> </th>
                    </tr>
                @endforeach
            </table>

            {{ $events->links() }}
        @else
            <p class="text-center">No scheduled Publicity Event found. If you want to schedule a new event click the "Create" button.</p>
        @endif
    </main>
</x-layout>
