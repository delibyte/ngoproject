<x-layout>
    <x-setting :heading="'Edit Indigent Information: ' . $indigent->user->name" class="w-10/12 mx-auto">
        <form method="POST" action="{{ route('indigents.update', $indigent->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$indigent->user->name" disabled />

            <x-form.field>
                <x-form.label name="Region" />
                <select name="region_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Area::all() as $area)
                        <option
                            value="{{ $area->id }}"
                            {{ $indigent->region_id == $area->id ? 'selected' : '' }}
                        >{{ ucwords($area->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="type_id"/>
            </x-form.field>

            <x-form.input name="income" type="number" :value="old('income', $indigent->income)" required />
            <x-form.input name="expenditure" type="number" :value="old('expenditure', $indigent->expenditure)" required />

            <x-form.field>
                <x-form.label name="Aid Type" />
                <select name="aid_type" required class="p-2 rounded-md">
                    @foreach (\App\Models\DonationType::all() as $type)
                        <option
                            value="{{ $type->id }}"
                            {{ $indigent->aidType->id == $type->id ? 'selected' : '' }}
                        >{{ ucwords($type->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="aid_type"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Family Members" />

                @if ( count($indigent->family) > 0 )
                <div class="p-2 w-7/12 rounded-md border mb-4">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="text-sm"> Underage </th>
                                <th class="text-sm"> Educational Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($indigent->family as $member)
                            <tr class="border-t border-gray-200">
                                <th class="font-normal text-sm p-2"> {{ $member->is_child ? "Yes" : "No" }} </th>
                                <th class="font-normal text-sm p-2"> {{ ucfirst($member->educational_status) }} </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <span>This user does not have any family members listed in their application.</span>
                @endif
            </x-form.field>

            <x-form.field>
                <x-form.label name="Status" />
                <select name="status" class="p-2 rounded-md" {{ Auth::user()->hasRole('administrator') ? "required" : "disabled" }}>
                    <option value="pending" {{ $indigent->status == "pending" ? "selected" : "" }} > Pending </option>
                    <option value="active" {{ $indigent->status == "active" ? "selected" : "" }} > Active </option>
                    <option value="revoked" {{ $indigent->status == "revoked" ? "selected" : "" }} > Revoked </option>
                </select>
                <x-form.error name="status"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

        @if ( Auth::user()->hasRole('administrator') )
            <form method="POST" action="{{ route('indigents.destroy', $indigent->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-400 mt-4 hover:bg-red-500">Delete</x-button>
            </form>
        @endif

    </x-setting>
</x-layout>
