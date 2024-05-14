<x-layout>
    <x-setting heading="Create New area" class="shadow-xl">
        <form method="POST" action=" {{ route('areas.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" required />
            <x-form.input name="description" required />

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>
</x-layout>
