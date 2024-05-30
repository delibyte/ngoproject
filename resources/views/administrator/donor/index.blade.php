<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Donors</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('donors.applications') }}" class="inline-block w-full"> Evaluate Applications </a>
        </x-button>

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($donors->count())
            @foreach ($donors as $donor)
            <x-panel class="shadow-md">
                <ul>
                    <li>
                        <div class="flex place-content-between items-center">
                            <span class="font-bold flex-1"> {{ $donor->user->name }} </span>

                            <button class="bg-yellow-400 p-2 rounded-md mr-2">
                                <a class="font-bold text-white" href="{{ route('donors.edit', $donor->id) }}"> Edit </a>
                            </button>
                        </div>
                    </li>
                </ul>
            </x-panel>
            @endforeach

            {{ $donors->links() }}
        @else
            <p class="text-center">No donor applications has been approved yet. If you want to evaluate new applications click the "Evaluate" button..</p>
        @endif
    </main>
</x-layout>
