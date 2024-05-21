<x-layout>
    <x-setting heading="Send New Notification" class="shadow-xl">
        <form method="POST" action=" {{ route('notifications.store') }} " enctype="multipart/form-data">
            @csrf

            <x-form.field>
                <x-form.label name="type"/>

                    <select name="type" required class="p-2 rounded-md">
                        <option value="email" > Email </option>
                        <option value="sms" > SMS </option>
                    </select>

                <x-form.error name="type"/>
            </x-form.field>

            <x-form.field>
                <x-form.input name="username" id="username"/>
                <select name="receiver" id="receiver" class="mt-2 p-2 rounded-md" required>
                </select>
            </x-form.field>

            <x-form.input name="description" required />

            <x-form.button>Save</x-form.button>
        </form>
    </x-setting>

    <script>
        $('#username').on('keyup',function(){
            let name = $('#username').val();
            $.ajax({
                url:"{{ route('admin.usersearch') }}",
                method: "GET",
                data: { name: name },
                success: function (res) {
                    var html = '';
                    $.each(res, function (index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</p>';
                    });
                    $('#receiver').html(html);
                }
            });
        });
    </script>
</x-layout>
