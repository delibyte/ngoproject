<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <x-button class="mb-4">
            <a href="{{ url()->previous() }}"> Go Back </a>
        </x-button>

        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Volunteer Applications</span>
        </h1>
    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-11/12 mx-auto border rounded-md shadow-xl">
        @if ($applications->count())

            <table class="table-auto w-full">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="p-2"> Name </th>
                        <th> Profession </th>
                        <th> Income </th>
                        <th> Region </th>
                        <th> Transportation </th>
                        <th> Available Days </th>
                        <th> Action </th>
                    </tr>
                </thead>
            @foreach ($applications as $application)
                <tr class="border border-t-gray-400">
                    <th class="font-normal p-2"> {{ ucfirst($application->user->name) }} </th>
                    <th class="font-normal"> {{ $application->profession }} </th>
                    <th class="font-normal"> {{ $application->income }} </th>
                    <th class="font-normal"> {{ $application->region->name }} </th>
                    <th class="font-normal"> {{ $application->transportation ? "Yes" : "No" }} </th>
                    <th class="font-normal"> {{ $application->availability_count }} </th>
                    <th> <a href="{{ route('volunteers.edit', $application->id) }}" class="text-blue-500"> View </a> </th>
                </tr>
            @endforeach
            </table>

            {{ $applications->links() }}
    @else
        <p class="text-center p-4">Seems like there aren't any applications yet. Come back later to check for new applications.</p>
    @endif
    </main>
</x-layout>
