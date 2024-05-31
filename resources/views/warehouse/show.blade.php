<x-layout>
    <div class="w-7/12 mx-auto -mb-28">
        <x-setting :heading="'Warehouse Information'" link="{{ route('warehouses.index') }}">
            <form method="POST" action="{{ route('warehouses.update', $warehouse->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

            @if ( Auth::user()->hasRole('administrator') )
                <x-form.input name="name" :value="old('name', $warehouse->name)" required />

                <x-form.label name="type"/>
                <select name="region_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Area::all() as $area)
                        <option
                            value="{{ $area->id }}"
                            {{ $area->id == $warehouse->region_id ? 'selected' : '' }}
                        >{{ $area->name }}</option>
                    @endforeach
                </select>

                <x-form.input name="location" :value="old('location', $warehouse->location)" required />

                <x-form.button class="shadow-xl">Update</x-form.button>
            @else
                <x-form.input name="name" :value="old('name', $warehouse->name)" disabled />
                <x-form.input name="location" :value="old('location', $warehouse->location)" disabled />
            @endif
            </form>
        </x-setting>
    </div>

    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            <span class="text-blue-500">Warehouse Items</span>
        </h1>
    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-10/12">
        @if ($items->count())
            <table class="table-fixed w-5/12 mx-auto">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="p-2"> Type </th>
                        <th class="p-2"> Amount </th>
                    </tr>
                </thead>
                @foreach ($items as $type => $count)
                <tr class="border border-t-gray-400">
                    <th class="p-2 font-normal"> {{ ucfirst($type) }} </th>
                    <th class="p-2 font-normal"> {{ $count }} </th>
                </tr>
                @endforeach
            </table>
        @else
            <p class="text-center">No items are located in this warehouse yet.</p>
        @endif
    </main>
</x-layout>
