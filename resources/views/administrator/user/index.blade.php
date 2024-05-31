<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Current <span class="text-blue-500">Users</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('dashboard') }}" class="inline-block w-full"> Go Back </a>
        </x-button>

    </header>

    <main class="max-w-6xl w-7/12 mx-auto mt-3 lg:mt-10 space-y-6">
        <form method="GET" action=" {{ route('users.index') }} " enctype="multipart/form-data">
            @csrf

            <x-form.field>
                <input type="hidden" id="filterByName" name="filterByName" value="1">
                <input type="hidden" id="paginateResults" name="paginateResults" value="1">
                <x-form.input name="name" id="name"/>
            </x-form.field>

            <x-form.button>Search</x-form.button>
        </form>

        @if ($users->count())
            <div class="border border-gray-400 rounded-md shadow-xl">
                <table class="table-auto w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-2"> Name </th>
                            <th> Status </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                @foreach ($users as $user)
                    <tr class="border border-t-gray-400">
                        <th class="font-normal p-2"> {{ $user->name }} </th>
                        <th class="font-normal"> {{ ucfirst($user->status) }} </th>
                        <th> <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500"> Edit </a> </th>
                    </tr>
                @endforeach
                </table>
            </div>

            {{ $users->links() }}
        @else
            <p class="text-center">No users found. Check again later or fabricate fake data.</p>
        @endif
    </main>
</x-layout>
