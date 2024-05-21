<x-layout>
    <x-setting heading="Send New Notification" class="shadow-xl w-10/12 mx-auto">
        <x-form.input name="name" :value="old('name', $notification->user->name)" disabled />
        <x-form.textarea name="subject" disabled>
            {{ $notification->subject }}
        </x-form.textarea>
        <x-form.input name="date" :value="old('date', $notification->created_at)" disabled />
    </x-setting>
</x-layout>
