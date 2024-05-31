<x-layout>
    <x-setting :heading="'Edit Donor Application'" link="{{ route('donor.donations.index') }}" class="w-10/12 mx-auto">
        <form id="donorForm" method="POST" action="{{ route('donor.application.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$donor->user->name" disabled />
            <x-form.input name="income" type="number" :value="old('income', $donor->income)" required />

            <x-form.field>
                <x-form.label name="Region" />
                <select name="region_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Area::all() as $area)
                        <option
                            value="{{ $area->id }}"
                            {{ $donor->region->id == $area->id ? 'selected' : '' }}
                        >{{ ucwords($area->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="type_id"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

    </x-setting>
</x-layout>
