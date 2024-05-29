<x-layout>
    <x-setting heading="Create New Warehouse" class="shadow-xl">
        <form method="POST" action=" {{ route('warehouses.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" required />

            <x-form.label name="type"/>
            <select name="region_id" required class="p-2 rounded-md">
                @foreach (\App\Models\Area::all() as $area)
                    <option
                        value="{{ $area->id }}"
                        {{ old('area_id') == $area->id ? 'selected' : '' }}
                    >{{ $area->name }}</option>
                @endforeach
            </select>

            <x-form.input name="location" required />

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>
</x-layout>
