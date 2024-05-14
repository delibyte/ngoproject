<x-layout>
    <x-setting heading="New Donation">
        <form method="POST" action=" {{ route('donations.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.field>
                <x-form.label name="type"/>

                <select name="type_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\DonationType::all() as $type)
                        <option
                            value="{{ $type->id }}"
                            {{ old('type_id') == $type->id ? 'selected' : '' }}
                        >{{ ucwords($type->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="type_id"/>
            </x-form.field>

            <x-form.input name="amount" required />

            <x-form.field>
                <x-form.label name="delivery_type"/>

                <select name="delivery_type" id="delivery_type" required class="p-2 rounded-md">
                    @foreach (['by-us', 'to-us'] as $type)
                        <option
                            value="{{ $type }}"
                            {{ old('type') == $type ? 'selected' : '' }}
                        >{{ ucwords($type) }}</option>
                    @endforeach
                </select>

                <x-form.error name="delivery_type"/>
            </x-form.field>

            <x-form.button>Donate</x-form.button>
        </form>
    </x-setting>
</x-layout>
