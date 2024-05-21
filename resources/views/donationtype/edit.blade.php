<x-layout>
    <x-setting :heading="'Edit Donation Type: ' . $type->name">
        <form method="POST" action=" {{ route('types.update', ['type' => $type->id ]) }} " enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $type->name)" required />
            <x-form.input name="min_amount" type="number" min="1" :value="old('min_amount', $type->min_amount)" required />

            <x-form.button class="shadow-xl">Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
