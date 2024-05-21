<x-layout>
    <x-setting heading="Create New Donation Type" class="shadow-xl">
        <form method="POST" action=" {{ route('types.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" required />
            <x-form.input name="min_amount" type="number" min="1" required />

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>
</x-layout>
