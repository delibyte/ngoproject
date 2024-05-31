<x-layout>
    <x-setting :heading="'Apply For Volunteership'" class="w-10/12 mx-auto">

        <x-form.input name="name" :value="$volunteer->user->name" disabled />
        <x-form.input name="profession" :value="$volunteer->profession" disabled />
        <x-form.input name="income" type="number" :value="$volunteer->income" disabled />
        <x-form.input name="region" :value="$volunteer->region->name" disabled />

        <x-form.input name="Can You Handle Your Own Transportation" :value="$volunteer->transportation ? 'Yes' : 'No'" disabled />

        <x-form.field>
            <x-form.label name="Availability" />
            <div class="p-2 w-7/12 rounded-md border mb-4">
                <table class="table-auto w-full" id="availability_table">
                    <thead>
                        <tr>
                            <th class="text-sm"> Week </th>
                            <th class="text-sm"> Day </th>
                            <th class="text-sm"> Start Time </th>
                            <th class="text-sm"> End Time </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($volunteer->availability as $availability)
                        <tr class="border-t border-gray-200">
                            <th class="p-2 font-normal text-sm">{{ ucfirst($availability->week) }}</th>
                            <th class="font-normal text-sm">{{ ucfirst($availability->day) }}</th>
                            <th class="font-normal text-sm">{{ substr($availability->start_time,0,5) }}</th>
                            <th class="font-normal text-sm">{{ substr($availability->end_time,0,5) }}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-form.field>

        <a href="{{ route('volunteer.application.edit') }}">
            <x-button id="updateButton" class="mt-6">Edit</x-button>
        </a>
    </x-setting>
</x-layout>
