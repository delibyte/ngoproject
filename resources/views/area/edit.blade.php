<x-layout>
    <x-setting :heading="'Edit Area: ' . $area->name" link="{{ route('areas.index') }}">
        <form method="POST" action="{{ route('areas.update', $area->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $area->name)" required />
            <x-form.input name="description" :value="old('description', $area->description)" required />

            <x-form.button class="shadow-xl">Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
