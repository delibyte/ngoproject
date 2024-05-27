<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Shipments</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('shipments.create') }}" class="inline-block w-full"> New Shipment </a>
        </x-button>
    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6">
        @if ($shipments->count())
            <table class="table-fixed w-full">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="p-2 w-1/12"> Type </th>
                        <th class="p-2 w-1/12"> Amount </th>
                        <th class="w-4/12"> Receiver </th>
                        <th class="w-4/12"> Dispatcher </th>
                        <th class="text-center w-2/12"> Completed </th>
                        <th class="text-center w-1/12"> Action </th>
                    </tr>
                </thead>
                @foreach ($shipments as $shipment)
                <tr class="border border-t-gray-400">
                    @if ( count($shipment->item) > 0 )
                        <th class="p-2 font-normal"> {{ ucfirst( $shipment->item[0]->type->name ) }} </th>
                        <th class="p-2 font-normal"> {{ count($shipment->item) }} </th>
                    @else
                        <th class="p-2 font-normal"> {{ 'Cash' }} </th>
                        <th class="p-2 font-normal"> {{ $shipment->banklog->amount }} </th>
                    @endif
                    <th class="p-2 font-normal"> {{ $shipment->receiver->name }} </th>
                    <th class="p-2 font-normal"> {{ $shipment->dispatcher->name }} </th>
                    <th class="p-2 font-normal"> {{ ucwords($shipment->completion) }} </th>
                    <th> <a href="{{ route('shipments.show', $shipment->id) }}" class="text-blue-500 font-bold"> View </a> </th>
                </tr>
                @endforeach
            </table>

            {{ $shipments->links() }}
        @else
            <p class="text-center">No shipments found. If you want to crate a new shipment click the "New Shipment" button..</p>
        @endif
    </main>
</x-layout>
