<x-layout>
    <x-setting :heading="'Edit User Information'" class="w-10/12 mx-auto">
        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$user->name" />
            <x-form.input name="phone" :value="$user->phone" />
            <x-form.input name="address" :value="$user->address" />
            <x-form.input name="email" :value="$user->email" />

            <x-form.input name="status" :value="ucfirst($user->status)" disabled />

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>
    </x-setting>
</x-layout>
