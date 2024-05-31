<x-layout>
    <main class="flex items-center justify-center h-screen"
        <div class="mx-auto mt-3 lg:mt-10 space-y-6">
            <div class="w-6/12 flex flex-col gap-y-6 py-6 justify-center border border-gray-300 rounded-md">

                @if ( Auth::user()->hasRole('volunteer') )
                <a href="/volunteer/shipments" class="w-10/12 mx-auto">
                    <button class="w-full p-2 bg-yellow-500 font-bold text-white rounded-md">
                        Go To Volunteer Dashboard
                    </button>
                </a>
                @else
                <a href="/apply/volunteership" class="w-10/12 mx-auto">
                    <button class="w-full p-2 bg-blue-500 font-bold text-white rounded-md">
                        Apply for Volunteership
                    </button>
                </a>
                @endif

                @if ( Auth::user()->hasRole('indigent') )
                <a href="/indigent/dashboard" class="w-10/12 mx-auto">
                    <button class="w-full p-2 bg-yellow-500 font-bold text-white rounded-md">
                        Go To Indigent Dashboard
                    </button>
                </a>
                @else
                <a href="/apply/indigentship" class="w-10/12 mx-auto">
                    <button class="w-full p-2 bg-blue-500 font-bold text-white rounded-md">
                        Apply for Indigentship
                    </button>
                </a>
                @endif

                @if ( Auth::user()->hasRole('donor') )
                <a href="/donations" class="w-10/12 mx-auto">
                    <button class="w-full p-2 bg-yellow-500 font-bold text-white rounded-md">
                        Go To Donor Dashboard
                    </button>
                </a>
                @else
                <a href="/apply/donorship" class="w-10/12 mx-auto">
                    <button class="w-full p-2 bg-blue-500 font-bold text-white rounded-md">
                        Apply for Donorship
                    </button>
                </a>
                @endif

            </div>
        </div>
    </main>
</x-layout>
