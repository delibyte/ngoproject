<x-layout>
    <x-setting :heading="'Apply For Volunteership'" link="{{ route('indigent.dashboard.index') }}" class="w-10/12 mx-auto">

        <x-form.input name="name" :value="$indigent->user->name" disabled />
        <x-form.input name="region" :value="$indigent->region->name" disabled />
        <x-form.input name="income" type="number" :value="$indigent->income" disabled />
        <x-form.input name="expenditure" type="number" :value="$indigent->expenditure" disabled />
        <x-form.input name="aid type" :value="ucfirst($indigent->aidType->name)" disabled />
        <x-form.input name="status" :value="ucfirst($indigent->status)" disabled />

        <x-form.field>
            <x-form.label name="Family Members" />
            <div class="p-2 w-7/12 rounded-md border mb-4">
                <table class="table-auto w-full" id="family_members_table">
                    <thead>
                        <tr>
                            <th class="text-sm"> Underage? </th>
                            <th class="text-sm"> Educational Status </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($indigent->family as $member)
                        <tr class="border-t border-gray-200">
                            <th class="p-2 font-normal text-sm">{{ $member->is_child ? "Yes" : "No" }}</th>
                            <th class="font-normal text-sm">{{ ( $member->educational_status == "primary" ||
                                                                $member->education_status == "seconday" ) ?
                                                                ucfirst($member->educational_status) . " School" :
                                                                ucfirst($member->educational_status) }}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-form.field>

        <a href="{{ route('indigent.application.edit') }}">
            <x-button id="updateButton" class="mt-6">Edit</x-button>
        </a>
    </x-setting>
</x-layout>
