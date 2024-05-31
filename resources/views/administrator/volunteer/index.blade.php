<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Volunteers</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('dashboard') }}" class="inline-block w-full"> Go Back </a>
        </x-button>

        @if ( Auth::user()->hasRole('administrator') )
        <x-button class="mt-6 ml-2 shadow-xl">
            <a href="{{ route('volunteers.applications') }}" class="inline-block w-full"> Evaluate Applications </a>
        </x-button>
        @endif

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($volunteers->count())
            @foreach ($volunteers as $volunteer)
            <x-panel class="shadow-md">
                <ul>
                    <li>
                        <div class="flex place-content-between items-center">
                            <span class="font-bold flex-1"> {{ $volunteer->user->name }} </span>

                            @if ( Auth::user()->hasRole('administrator') )
                            <button class="bg-yellow-400 p-2 rounded-md mr-2">
                                <a class="font-bold text-white" href="{{ route('volunteers.edit', $volunteer->id) }}"> Edit </a>
                            </button>
                            @endif
                        </div>
                    </li>
                </ul>
            </x-panel>
            @endforeach

            {{ $volunteers->links() }}
        @else
            <p class="text-center">No volunteer applications has been approved yet. If you want to evaluate new applications click the "Evaluate" button..</p>
        @endif
    </main>
</x-layout>
