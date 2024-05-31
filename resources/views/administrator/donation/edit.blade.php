<x-layout>
    <x-setting :heading="'Edit Donation Information'" class="w-10/12 mx-auto">
        <form method="POST" action="{{ route('donations.update', $donation->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$donation->donor->user->name" disabled />

            <x-form.field>
                <x-form.label name="type_id" />
                <select name="type_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\DonationType::all() as $type)
                        <option
                            value="{{ $type->id }}"
                            {{ $donation->type->id == $type->id ? 'selected' : '' }}
                        >{{ ucwords($type->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="type_id"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Delivery Type" />
                <select name="delivery_type" class="p-2 rounded-md">
                    <option value="to-us" {{ $donation->delivery_type == "to-us" ? "selected" : "" }} > To-us </option>
                    <option value="by-us" {{ $donation->delivery_type == "by-us" ? "selected" : "" }} > By-us </option>
                </select>
                <x-form.error name="delivery_type"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Approval Status" />
                <select name="approval" class="p-2 rounded-md" {{ Auth::user()->hasRole('administrator') ? "required" : "disabled" }}>
                    <option value="pending" {{ $donation->approval == "pending" ? "selected" : "" }} > Pending </option>
                    <option value="accepted" {{ $donation->approval == "accepted" ? "selected" : "" }} > Accepted </option>
                    <option value="rejected" {{ $donation->approval == "rejected" ? "selected" : "" }} > Rejected </option>
                </select>
                <x-form.error name="approval"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Collected" />
                <select name="collected" class="p-2 rounded-md" {{ Auth::user()->hasRole('administrator') ? "required" : "disabled" }}>
                    <option value="1" {{ $donation->collected ? "selected" : "" }} > Yes </option>
                    <option value="0" {{ !($donation->collected) ? "selected" : "" }} > No </option>
                </select>
                <x-form.error name="collected"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="warehouse" />
                <select name="warehouse_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Warehouse::all() as $warehouse)
                        <option
                            value="{{ $type->id }}"
                            {{ $donation->warehouse_id == $warehouse->id ? 'selected' : '' }}
                        >{{ ucwords($warehouse->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="warehouse_id"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

        @if ( Auth::user()->hasRole('administrator') )
            <form method="POST" action="{{ route('donations.destroy', $donation->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-400 mt-4 hover:bg-red-500">Delete</x-button>
            </form>
        @endif

    </x-setting>
</x-layout>
