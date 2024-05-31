<x-layout>
    <x-setting :heading="'Edit Event: ' . $event->name" link="{{ route('events.index') }}">
        <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="old('name', $event->name)" required />
            <x-form.input name="description" :value="old('description', $event->description)" required />
            <x-form.input name="held_at" :value="old('held_at', $event->held_at)" type="datetime-local" required />

            <div class="flex gap-x-4">
                <x-form.button class="shadow-xl">Update</x-form.button>

            </div>
        </form>

        <form method="POST" action="{{ route('events.destroy', $event->id) }}" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <x-form.button class="shadow-xl">Delete</x-form.button>
        </form>
    </x-setting>
</x-layout>
