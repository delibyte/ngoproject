<x-layout>
    <x-setting :heading="'Edit Donor Information: ' . $donor->user->name" link="{{ route('donors.index') }}" class="w-10/12 mx-auto">
        <form id="donorForm" method="POST" action="{{ route('donors.update', $donor->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$donor->user->name" disabled />

            <x-form.field>
                <x-form.label name="Region" />
                <select name="region_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Area::all() as $area)
                        <option
                            value="{{ $area->id }}"
                            {{ old('region_id') == $area->id ? 'selected' : '' }}
                        >{{ ucwords($area->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="type_id"/>
            </x-form.field>

            <x-form.input name="income" :value="$donor->income" />

            <x-form.field>
                <x-form.label name="Status" />
                <select name="status" class="p-2 rounded-md" {{ Auth::user()->hasRole('administrator') ? "required" : "disabled" }}>
                    <option value="pending" {{ $donor->status == "pending" ? "selected" : "" }} > Pending </option>
                    <option value="active" {{ $donor->status == "active" ? "selected" : "" }} > Active </option>
                    <option value="revoked" {{ $donor->status == "revoked" ? "selected" : "" }} > Revoked </option>
                </select>
                <x-form.error name="status"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

        @if ( Auth::user()->hasRole('administrator') )
            <form method="POST" action="{{ route('donors.destroy', $donor->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-400 mt-4 hover:bg-red-500">Delete</x-button>
            </form>
        @endif
    </x-setting>
</x-layout>
