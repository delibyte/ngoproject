<x-layout>
    <x-setting :heading="'Editing Users for ' . ucfirst($role->name) . ' Role'" class="shadow-xl">

            <x-form.input name="name" :value="ucfirst(old('name', $role->name))" disabled/>

            <x-form.label name="users" class="mt-3" />


        <main class="max-w-6xl mx-auto mt-2 lg:mt-5 space-y-6">
            @foreach ($users as $user)
            <x-panel class="mb-3 shadow-md">
                <ul>
                    <li>
                        <div class="flex place-content-between items-center">
                            <span class="font-bold flex-1"> {{ $user->name }} </span>

                            <form action="{{ route('roles.index') . '/' . $role->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input name="user_id" value="{{ $user->id }}" hidden required />
                                <input class="font-bold text-white bg-red-400 p-2 rounded-md" type="submit" value="Remove User"></input>
                            </form>
                        </div>
                    </li>
                </ul>
            </x-panel>
        </main>
            @endforeach


    </x-setting>
</x-layout>
