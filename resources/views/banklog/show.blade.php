<x-layout>
    <x-setting :heading="'Viewing Donation Information'">

            <x-form.input name="type" :value="ucfirst($log->type)" disabled/>
            <x-form.input name="amount" :value="$log->amount" disabled/>
            <x-form.input name="balance at that time" :value="$log->balance" disabled/>
            <x-form.input name="donated" :value="($log->donation != null) ? 'True' : 'False'" disabled/>
            <x-form.input name="shipped" :value="($log->shipment != null) ? 'True' : 'False'" disabled/>

    </x-setting>
</x-layout>
