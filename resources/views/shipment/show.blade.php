<x-layout>
    <div class="w-7/12 mx-auto -mb-28">
        <x-setting :heading="'Shipment Information'">
            <form method="POST" action="{{ route('shipments.update', $shipment->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input name="shipment_id" value="{{ $shipment->id }}" hidden />
                <x-form.input name="type" :value="ucfirst($shipment->item ? 'cash' : $shipment->item->type->name)" disabled />
                <x-form.input name="amount" :value="$shipment->item ? $shipment->banklog->amount : $shipment->item->count()" disabled />
                <x-form.input name="receiver" :value="$shipment->receiver->name" disabled />
                <x-form.input name="dispatcher" :value="$shipment->dispatcher->name" disabled />
                <x-form.input name="update at" :value="$shipment->updated_at" disabled />
                <x-form.input name="created at" :value="$shipment->created_at" disabled />

                <x-form.label name="Completion Status" class="mt-6" />
                <select name="completion" required class="p-2 rounded-md">
                    <option value="cancelled" {{ $shipment->completion == "cancelled" ? "selected" : "" }} > Cancelled </option>
                    <option value="ongoing" {{ $shipment->completion == "ongoing" ? "selected" : "" }} > Ongoing </option>
                    <option value="completed" {{ $shipment->completion == "completed" ? "selected" : "" }} > Completed </option>
                </select>

                <x-form.button class="shadow-xl">Update</x-form.button>
            </form>

        </x-setting>
    </div>
</x-layout>
