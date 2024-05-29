<x-layout>
    <x-setting heading="New Shipment" class="shadow-xl">
        <form method="POST" action=" {{ route('shipments.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.label name="type"/>
            <select name="type_id" required class="p-2 rounded-md">
                @foreach (\App\Models\DonationType::all() as $type)
                    <option
                        value="{{ $type->id }}"
                        {{ old('type_id') == $type->id ? 'selected' : '' }}
                    >{{ ucwords($type->name) }}</option>
                @endforeach
            </select>

            <x-form.field>
                <x-form.input name="amount" id="amount" :value="old('amount')"/>
            </x-form.field>

            <x-form.field>
                <x-form.input name="receiver" id="receiver"/>
                <select name="receiver_id" id="receiver_id" class="mt-2 p-2 rounded-md" required>
                </select>
            </x-form.field>

            <x-form.field>
                <x-form.input name="dispatcher" id="dispatcher"/>
                <select name="dispatcher_id" id="dispatcher_id" class="mt-2 p-2 rounded-md" required>
                </select>
            </x-form.field>

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>

    <script>
        $('#receiver').on('keyup',function(){
            let receiver_username = $('#receiver').val();

            $.ajax({
                url:"{{ route('admin.usersearch') }}",
                method: "GET",
                data: { name: receiver_username },
                success: function (res) {
                    var receivers = '';
                    $.each(res, function (index, value) {
                        receivers += '<option value="' + value.id + '">' + value.name + '</p>';
                    });
                    $('#receiver_id').html(receivers);
                }
            });
        });


        $('#dispatcher').on('keyup',function(){
            let dispatcher_username = $('#dispatcher').val();

            $.ajax({
                url:"{{ route('admin.usersearch') }}",
                method: "GET",
                data: { name: dispatcher_username },
                success: function (res) {
                    var dispatchers = '';
                    $.each(res, function (index, value) {
                        dispatchers += '<option value="' + value.id + '">' + value.name + '</p>';
                    });
                    $('#dispatcher_id').html(dispatchers);
                }
            });
        });
    </script>
</x-layout>
