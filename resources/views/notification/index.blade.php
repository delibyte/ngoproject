<x-layout>
    <header class="max-w-xl mx-auto mt-20 text-center">
        <h1 class="text-4xl">
            Latest <span class="text-blue-500">Notifications</span>
        </h1>

        <x-button class="mt-6 shadow-xl">
            <a href="{{ route('notifications.create') }}" class="inline-block w-full"> Send New Notification </a>
        </x-button>

    </header>

    <main class="max-w-6xl mx-auto mt-3 lg:mt-10 space-y-6 w-10/12">
        @if ($notifications->count())
            <table class="table-fixed w-full">
                <thead class="bg-gray-300">
                    <tr>
                        <th class="p-2"> Receiver </th>
                        <th class="w-6/12"> Subject </th>
                        <th class=""> Date </th>
                        <th class="w-1/12"> Action </th>
                    </tr>
                </thead>
                @foreach ($notifications as $notification)
                <tr class="border border-t-gray-400">
                    <th class="p-2"> {{ $notification->user->name }} </th>
                    <th class="p-2 text-left font-normal"> {{ $notification->subject }} </th>
                    <th class="font-normal"> {{ $notification->created_at }} </th>
                    <th> <a href="{{ route('notifications.show', $notification->id) }}" class="text-blue-500"> View </a> </th>
                </tr>
                @endforeach
            </table>

            {{ $notifications->links() }}
        @else
            <p class="text-center">No notifications sent yet. If you want to send a new notification type click the "Send New Notification" button..</p>
        @endif
    </main>
</x-layout>
