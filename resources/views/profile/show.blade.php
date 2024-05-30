<x-layout>
    <x-setting :heading="'Edit User Information'" class="w-10/12 mx-auto">

        <x-form.input name="name" :value="$user->name" disabled />
        <x-form.input name="phone" :value="$user->phone" disabled />
        <x-form.input name="address" :value="$user->address" disabled />
        <x-form.input name="email" :value="$user->email" disabled />

        <x-form.input name="status" :value="ucfirst($user->status)" disabled />

        <div class="flex flex-row gap-x-2">
            <a href="/profile/edit">
                <x-button class="bg-yellow-400 mt-4 hover:bg-yellow-500">
                    Edit
                </x-button>
            </a>

            <form method="POST" action="{{ route('profile.destroy', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-400 mt-4 hover:bg-red-500">Delete</x-button>
            </form>
        </div>

    </x-setting>
</x-layout>
