<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Warehouses</span>
        </h1>

        @if ( Auth::user()->hasRole('administrator') )
        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('warehouses.create') }}" class="inline-block w-full"> Define New Warehouse </a>
        </x-button>
        @endif

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($warehouses->count())
            @foreach ($warehouses as $warehouse)
            <x-panel class="shadow-md">
                <ul>
                    <li>
                        <div class="flex place-content-between items-center">
                            <span class="font-bold flex-1"> {{ $warehouse->name }} </span>

                            <button class="bg-blue-400 p-2 rounded-md mr-2">
                                @if ( Auth::user()->hasRole('administrator') )
                                    <a class="font-bold text-white" href="{{ route('warehouses.show', $warehouse->id) }}"> Show </a>
                                @else
                                    <a class="font-bold text-white" href="{{ route('warehouses.show.coordinator', $warehouse->id) }}"> Show </a>
                                @endif
                            </button>

                            <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input class="font-bold text-white bg-red-400 p-2 rounded-md" type="submit" value="Delete"></input>
                            </form>
                        </div>
                    </li>
                </ul>
            </x-panel>
            @endforeach

            {{ $warehouses->links() }}
        @else
            <p class="text-center">No warehouses defined yet. If you want to define a new warehouse click the "Create" button..</p>
        @endif
    </main>
</x-layout>
