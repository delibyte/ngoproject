<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <x-button class="mb-4">
            <a href="{{ url()->previous() }}"> Go Back </a>
        </x-button>

        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Donation Applications</span>
        </h1>
    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-7/12 mx-auto">
        @if ($applications->count())
            <div class="border border-gray-400 rounded-md shadow-xl">
                <table class="table-auto w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-2"> Name </th>
                            <th> Type </th>
                            <th> Amount </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                @foreach ($applications as $application)
                    <tr class="border border-t-gray-400">
                        <th class="font-normal p-2"> {{ ucfirst($application->donor->name) }} </th>
                        <th class="font-normal"> {{ ucfirst($application->type->name) }} </th>
                        <th class="font-normal"> {{ $application->amount }} </th>
                        <th> <a href="{{ route('coordinator.donations.edit', $application->id) }}" class="text-blue-500"> View </a> </th>
                    </tr>
                @endforeach
                </table>
            </div>

            {{ $applications->links() }}
    @else
        <p class="text-center p-4">Seems like there aren't any applications yet. Come back later to check for new applications.</p>
    @endif
    </main>
</x-layout>
