<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Your <span class="text-blue-500">Donations</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('donations.create') }}" class="inline-block w-full"> Donate </a>
        </x-button>

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-8/12 mx-auto">
        @if ($donations->count())
            <div class="border rounded-md shadow-xl">
                <table class="table-auto w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-2"> Donation Type </th>
                            <th> Amount </th>
                            <th> Date </th>
                            <th> Approval </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                @foreach ($donations as $donation)
                    <tr class="border border-t-gray-400 {{ $donation->approval == "accepted" ? "bg-green-300" : "" }}
                                                        {{ $donation->approval == "pending" ? "bg-yellow-300" : "" }}
                                                        {{ $donation->approval == "rejected" ? "bg-red-300" : "" }}
                    ">
                        <th class="p-2 font-normal"> {{ ucfirst($donation->type->name) }} </th>
                        <th class="font-normal"> {{ $donation->amount }} </th>
                        <th class="font-normal"> {{ $donation->created_at }} </th>
                        <th class="font-normal"> {{ ucfirst($donation->approval) }} </th>
                        <th> <a href="{{ route('donations.show', $donation->id) }}" class="text-blue-500"> View </a> </th>
                    </tr>
                @endforeach
                </table>
            </div>

            {{ $donations->links() }}
    @else
        <p class="text-center p-4">Seems like you haven't made a donation yet. If you want to donate, click the "Donate" button.</p>
    @endif
    </main>
</x-layout>
