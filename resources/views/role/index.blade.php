<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Roles</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('dashboard') }}" class="inline-block w-full"> Go Back </a>
        </x-button>

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @foreach ($roles as $role)
        <x-panel class="shadow-md">
            <ul>
                <li>
                    <div class="flex place-content-between items-center">
                        <span class="font-bold flex-1"> {{ ucfirst($role->name) }} </span>

                        <button class="bg-yellow-400 p-2 rounded-md mr-2">
                            <a class="font-bold text-white" href="{{ route('roles.index') . '/' . $role->id }}/edit"> Edit Users </a>
                        </button>
                    </div>
                </li>
            </ul>
        </x-panel>
        @endforeach

        {{ $roles->links() }}
    </main>
</x-layout>
