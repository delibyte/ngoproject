<x-layout>
    <x-setting :heading="'Edit Volunteer Information: ' . $volunteer->user->name" class="w-10/12 mx-auto">
        <form id="volunteerForm" method="POST" action="{{ route('volunteers.update', $volunteer->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$volunteer->user->name" disabled />
            <x-form.input name="profession" :value="old('profession', $volunteer->profession)" required />
            <x-form.input name="income" type="number" :value="old('income', $volunteer->income)" required />

            <x-form.field>
                <x-form.label name="Region" />
                <select name="region_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Area::all() as $area)
                        <option
                            value="{{ $area->id }}"
                            {{ old('region_id') == $area->id ? 'selected' : '' }}
                        >{{ ucwords($area->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="type_id"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Transportation" />
                Can you handle your own transportation?
                <select name="transportation" required class="ml-2 p-2 rounded-md">
                        <option value="yes" {{ $volunteer->transportation == "yes" ? 'selected' : '' }}
                        >Yes</option>
                        <option value="no" {{ $volunteer->transportation == "no" ? 'selected' : '' }}
                        >No</option>
                </select>
                <x-form.error name="transportation"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Availability" />
                <div class="p-2 w-7/12 rounded-md border mb-4">
                    <table class="table-auto w-full" id="availability_table">
                        <thead>
                            <tr>
                                <th class="text-sm"> Week </th>
                                <th class="text-sm"> Day </th>
                                <th class="text-sm"> Start Time </th>
                                <th class="text-sm"> End Time </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($volunteer->availability as $availability)
                            <tr class="border-t border-gray-200">
                                <th class="p-2 font-normal text-sm">{{ ucfirst($availability->week) }}</th>
                                <th class="font-normal text-sm">{{ ucfirst($availability->day) }}</th>
                                <th class="font-normal text-sm">{{ substr($availability->start_time,0,5) }}</th>
                                <th class="font-normal text-sm">{{ substr($availability->end_time,0,5) }}</th>
                                <th><button type="button" class="removeRow bg-red-300 rounded-md px-2"> ⊖ </button></th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row items-start">
                    <div>
                        <x-form.label name="Week" />
                        <select id="week" name="week" class="p-2 rounded-md">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                        </select>
                    </div>

                    <div class="ml-2">
                        <x-form.label name="Day" />
                        <select id="day" name="day" class="p-2 rounded-md">
                                <option value="monday">Monday</option>
                                <option value="tuesday">Tuesday</option>
                                <option value="wednesday">Wednesday</option>
                                <option value="thursday">Thursday</option>
                                <option value="friday">Friday</option>
                                <option value="saturday">Saturday</option>
                                <option value="sunday">Sunday</option>
                        </select>
                    </div>

                    <div class="ml-2 flex flex-row gap-x-2 items-start -mt-6 mr-2">
                        <x-form.input name="start time" type="time"/>
                        <x-form.input name="end time" type="time"/>
                    </div>


                    <button id="addRow" type="button" class="rounded-md border border-gray-200 p-2 mt-6 bg-blue-400 font-bold text-white"> Add </button>
                </div>
                <x-form.error name="availability"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Status" />
                <select name="status" class="p-2 rounded-md" {{ Auth::user()->hasRole('administrator') ? "required" : "disabled" }}>
                    <option value="pending" {{ $volunteer->status == "pending" ? "selected" : "" }} > Pending </option>
                    <option value="active" {{ $volunteer->status == "active" ? "selected" : "" }} > Active </option>
                    <option value="revoked" {{ $volunteer->status == "revoked" ? "selected" : "" }} > Revoked </option>
                </select>
                <x-form.error name="status"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

        @if ( Auth::user()->hasRole('administrator') )
            <form method="POST" action="{{ route('volunteers.destroy', $volunteer->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <x-button class="bg-red-400 mt-4 hover:bg-red-500">Delete</x-button>
            </form>
        @endif

        <script>
        $(document).ready(function(){
            $("#addRow").click(function(event)
            {
                var week = $("#week").val();
                var day = $("#day").find("option:selected").text();
                var startTime = $('input[name="start time"]').val();
                var endTime = $('input[name="end time"]').val();

                let newRow = ' <tr class="border-t border-gray-200"> \
                               <th class="p-2 font-normal text-sm">' + week + '</th> \
                               <th class="font-normal text-sm">' + day + '</th> \
                               <th class="font-normal text-sm">' + startTime + '</th> \
                              <th class="font-normal text-sm">' + endTime + '</th> \
                              <th><button type="button" class="removeRow bg-red-300 rounded-md px-2"> ⊖ </button></th></tr>';
                $("#availability_table tbody").append(newRow);

            });

            $(document).on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });

            $("#volunteerForm").submit( function( event ) {
                var formData = new FormData($("#volunteerForm")[0]);
                var tableData = [];

                $("#availability_table tbody tr").each( function(row,tr) {
                    tableData[row] = {
                        "week" : $(tr).find('th:eq(0)').text(),
                        "day": $(tr).find('th:eq(1)').text().toLowerCase(),
                        "start_time": $(tr).find('th:eq(2)').text(),
                        "end_time": $(tr).find('th:eq(3)').text()
                    }
                });

                var serializedData = JSON.stringify(tableData);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'availability',
                    value: serializedData
                }).appendTo('#volunteerForm');

                return true;
            });
        });
        </script>
    </x-setting>
</x-layout>
