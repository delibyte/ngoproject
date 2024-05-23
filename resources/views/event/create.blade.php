<x-layout>
    <x-setting heading="Schedule New Event" class="shadow-xl">
        <form method="POST" action=" {{ route('events.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" required />
            <x-form.input name="description" required />
            <x-form.input name="held_at" type="datetime-local" required />

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>
</x-layout>
