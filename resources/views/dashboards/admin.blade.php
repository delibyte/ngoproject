<x-layout>
    <section class="pb-8 -mt-4 -ml-40 max-w-4xl mx-auto">
        <header class="max-w-xl mx-auto mt-20 text-center">
            @if ( Auth::user()->hasRole('administrator') )
            <h1 class="text-4xl">
                Administrator <span class="text-blue-500">Dashboard</span>
            @else
            <h1 class="text-4xl -ml-20">
                Coordinator <span class="text-blue-500">Dashboard</span>
            @endif
            </h1>
        </header>
    </section>

    <div class="mx-8 grid grid-cols-4 gap-x-2 gap-y-8 items-start">
        @if ( Auth::user()->hasRole('administrator') )
        <a href="{{ route('users.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/user.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Users</span>
                        <span class="font-bold text-sm">{{ $users }} Registered Users</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>

        <a href="{{ route('roles.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/role.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Roles</span>
                        <span class="font-bold text-sm">{{ $roles }} Defined Roles</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-sky-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>
        @endif

        <a href="{{ route('volunteers.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/volunteer.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Volunteers</span>
                        <span class="font-bold text-sm">{{ $volunteers }} Volunteers</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-yellow-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>

        <a href="{{ route('indigents.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/indigent.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Indigents</span>
                        <span class="font-bold text-sm">{{ $indigents }} Indigent People</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-red-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>

        <a href="{{ route('donors.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/help.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Donors</span>
                        <span class="font-bold text-sm">{{ $donors }} Kind Donors</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-purple-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>


        <a href="{{ route('banklogs.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 p-2
                {{ ( $balance < config('app.bank_minimum_balance') ? "bg-red-200" : "bg-gray-100" ) }}
                ">
                <div class="flex flex-row">
                    <img src="images/bank.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Bank Balance</span>
                        <span class="font-bold text-sm">{{ $balance }}₺ Turkish Liras</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-green-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>

        <a href="{{ route('areas.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/area.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Areas</span>
                        <span class="font-bold text-sm">{{ $areas }} Defined Areas</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-amber-700 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>

        <a href="{{ route('warehouses.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/warehouse.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Warehouses</span>
                        <span class="font-bold text-sm">{{ $warehouses }} Warehouses</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-teal-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>


        @if ( Auth::user()->hasRole('administrator') )
        <a href="{{ route('types.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/type.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Donation Types</span>
                        <span class="font-bold text-sm">{{ $donation_types }} Defined Type</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-blue-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>
        @endif

        <a href="{{ route('donations.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/donation.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Donations</span>
                        <span class="font-bold text-sm">{{ $donations }} Donated Goods</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-indigo-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>

        @if ( Auth::user()->hasRole('administrator') )
        <a href="{{ route('events.index') }}">
            <div class="w-11/12 mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/event.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Publicity Events</span>
                        <span class="font-bold text-sm">{{ $events }} Events Planned</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-indigo-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>
        @endif

        <a href="{{ route('shipments.index') }}">
            <div class="w-full mx-auto rounded-xl shadow-xl border border-gray-200 bg-gray-100 p-2">
                <div class="flex flex-row">
                    <img src="images/shipment.svg" width="40" class="ml-2"/>

                    <div class="flex flex-col text-gray-600 ml-4 mb-3">
                        <span class="font-bold text-xl mb-1">Ongoing Shipments</span>
                        <span class="font-bold text-sm">{{ $shipments }} Items Shipping</span>
                    </div>
                </div>

                <div class="w-full bg-gray-100 rounded-full h-2.5">
                    <div class="bg-emerald-500 h-2.5 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </a>
    </div>
</x-layout>
