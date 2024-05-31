<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Donations</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('donations.applications') }}" class="inline-block w-full"> Evaluate Applications </a>
        </x-button>

    </header>

    <main class="max-w-6xl w-7/12 mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($donations->count())
            <div class="border border-gray-400 rounded-md shadow-xl">
                <table class="table-auto w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-2"> Donor </th>
                            <th> Type </th>
                            <th> Date </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                @foreach ($donations as $donation)
                    <tr class="border border-t-gray-400">
                        <th class="font-normal p-2"> {{ $donation->donor->user->name }} </th>
                        <th class="font-normal"> {{ ucfirst($donation->type->name) }} </th>
                        <th class="font-normal"> {{ $donation->created_at }} </th>
                        <th> <a href="{{ route('donations.edit', $donation->id) }}" class="text-blue-500"> Edit </a> </th>
                    </tr>
                @endforeach
                </table>
            </div>

            {{ $donations->links() }}
        @else
            <p class="text-center">No donation applications has been approved yet. If you want to evaluate new applications click the "Evaluate" button..</p>
        @endif
    </main>
</x-layout>
