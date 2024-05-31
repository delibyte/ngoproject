<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Indigent People</span>
        </h1>

        @if ( Auth::user()->hasRole('administrator') )
        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('indigents.applications') }}" class="inline-block w-full"> Evaluate Applications </a>
        </x-button>
        @endif

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($indigents->count())
            @foreach ($indigents as $indigent)
            <x-panel class="shadow-md">
                <ul>
                    <li>
                        <div class="flex place-content-between items-center">
                            <span class="font-bold flex-1"> {{ $indigent->user->name }} </span>

                            @if ( Auth::user()->hasRole('administrator') )
                            <button class="bg-yellow-400 p-2 rounded-md mr-2">
                                <a class="font-bold text-white" href="{{ route('indigents.edit', $indigent->id) }}"> Edit </a>
                            </button>
                            @endif
                        </div>
                    </li>
                </ul>
            </x-panel>
            @endforeach

            {{ $indigents->links() }}
        @else
            <p class="text-center">No indigent applications has been approved yet. If you want to evaluate new applications click the "Evaluate" button..</p>
        @endif
    </main>
</x-layout>
