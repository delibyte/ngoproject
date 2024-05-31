<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Aids</span>
        </h1>
    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-10/12 mx-auto">
        @if ($shipments->count())
            <div class="border border-gray-400 rounded-md shadow-xl">
                <table class="table-auto w-full">
                    <thead class="bg-gray-300">
                        <tr>
                            <th class="p-2"> Type </th>
                            <th> Amount </th>
                            <th> Date </th>
                            <th> Completion </th>
                        </tr>
                    </thead>
                @foreach ($shipments as $shipment)
                    <tr class="border border-t-gray-400 {{ $shipment->completion == "completed" ? "bg-green-300" : "" }}
                                                        {{ $shipment->completion == "ongoing" ? "bg-yellow-300" : "" }}
                                                        {{ $shipment->completion == "cancelled" ? "bg-red-300" : "" }}
                    ">
                        @if ( count($shipment->item) > 0 )
                            <th class="p-2 font-normal"> {{ ucfirst( $shipment->item[0]->type->name ) }} </th>
                            <th class="p-2 font-normal"> {{ count($shipment->item) }} </th>
                        @else
                            <th class="p-2 font-normal"> {{ 'Cash' }} </th>
                            <th class="p-2 font-normal"> {{ $shipment->banklog->amount }} </th>
                        @endif
                        <th class="font-normal"> {{ $shipment->created_at }} </th>
                        <th class="font-normal"> {{ ucfirst($shipment->completion) }} </th>
                    </tr>
                @endforeach
                </table>
            </div>

            {{ $shipments->links() }}
    @else
        <p class="text-center p-4">Seems like there aren't any shipments. Check again later.</p>
    @endif
    </main>
</x-layout>
