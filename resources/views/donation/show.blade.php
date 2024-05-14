<x-layout>
    <x-setting :heading="'Viewing Donation Information'">

            <x-form.input name="type" :value="ucfirst($donation->type->name)" disabled/>
            <x-form.input name="amount" :value="$donation->amount" disabled/>
            <x-form.input name="approval" :value="ucfirst($donation->approval)" disabled/>
            <x-form.input name="delivery type" :value="ucfirst($donation->delivery_type)" disabled/>
            <x-form.input name="collected" :value="ucfirst($donation->collected ? 'Yes' : 'No')" disabled/>
            <x-form.input name="donated at" :value="$donation->created_at" disabled/>


            @if ( $donation->approval != 'approved' && !($donation->collected) )
            <form action="{{ route('donations.index') . '/' . $donation->id }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input class="font-bold text-white bg-red-400 p-2 rounded-md mt-4" type="submit" value="Delete"></input>
            </form>
            @endif

    </x-setting>
</x-layout>
