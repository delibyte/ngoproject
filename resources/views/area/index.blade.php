<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Areas</span>
        </h1>

        @if ( Auth::user()->hasRole('administrator') )
        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('areas.create') }}" class="inline-block w-full"> Create </a>
        </x-button>
        @endif

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($areas->count())
            @foreach ($areas as $area)
            <x-panel class="shadow-md">
                <ul>
                    <li>
                        <div class="flex place-content-between items-center">
                            <span class="font-bold flex-1"> {{ $area->name }} </span>

                            @if ( Auth::user()->hasRole('administrator') )
                            <button class="bg-yellow-400 p-2 rounded-md mr-2">
                                <a class="font-bold text-white" href="{{ route('areas.edit', $area->id) }}"> Edit </a>
                            </button>

                            <form action="{{ route('areas.destroy', $area->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input class="font-bold text-white bg-red-400 p-2 rounded-md" type="submit" value="Delete"></input>
                            </form>
                            @endif
                        </div>
                    </li>
                </ul>
            </x-panel>
            @endforeach

            {{ $areas->links() }}
        @else
            <p class="text-center">No areas defined yet. If you want to define a new area click the "Create" button..</p>
        @endif
    </main>
</x-layout>
