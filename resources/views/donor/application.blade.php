<x-layout>
    <x-setting :heading="'Apply For Donorship'" class="w-10/12 mx-auto">

        <x-form.input name="name" :value="$donor->user->name" disabled />
        <x-form.input name="income" type="number" :value="$donor->income" disabled />
        <x-form.input name="region" :value="$donor->region->name" disabled />

        <a href="{{ route('donor.application.edit') }}">
            <x-button id="updateButton" class="mt-6">Edit</x-button>
        </a>
    </x-setting>
</x-layout>
