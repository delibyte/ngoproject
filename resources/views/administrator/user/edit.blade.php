<x-layout>
    <x-setting :heading="'Edit User Information'" class="w-10/12 mx-auto">
        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$user->name" />
            <x-form.input name="phone" :value="$user->phone" />
            <x-form.input name="address" :value="$user->address" />
            <x-form.input name="email" :value="$user->email" />

            <x-form.field>
                <x-form.label name="Approval Status" />
                <select name="status" class="p-2 rounded-md" {{ Auth::user()->hasRole('administrator') ? "required" : "disabled" }}>
                    <option value="pending" {{ $user->status == "pending" ? "selected" : "" }} > Pending </option>
                    <option value="active" {{ $user->status == "active" ? "selected" : "" }} > Active </option>
                    <option value="banned" {{ $user->status == "banned" ? "selected" : "" }} > Banned </option>
                </select>
                <x-form.error name="status"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

        @if ( Auth::user()->hasRole('administrator') )
            <form method="POST" action="{{ route('users.destroy', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-400 mt-4 hover:bg-red-500">Delete</x-button>
            </form>
        @endif

    </x-setting>
</x-layout>
