<x-layout>
    <x-setting heading="Create New Warehouse" class="shadow-xl">
        <form method="POST" action=" {{ route('warehouses.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" required />
            <x-form.input name="location" required />

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>
</x-layout>
