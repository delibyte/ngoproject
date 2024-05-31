<x-layout>
    <x-setting :heading="'Apply For Donorship'" class="w-10/12 mx-auto">
        <form id="volunteerForm" method="POST" action="{{ route('donor.application.store') }}" enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" :value="$user->name" disabled />
            <x-form.input name="income" type="number" :value="old('income')" required />

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
                <x-form.error name="region_id"/>
            </x-form.field>

            <x-button id="createButton" class="mt-6">Send</x-button>
        </form>

    </x-setting>
</x-layout>
